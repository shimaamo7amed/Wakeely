<?php

namespace App\Functions;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
// استدعاء الـ Facade الخاص بـ Laravel Bridge
use Intervention\Image\Laravel\Facades\Image;
// استدعاء المشفرات (Encoders) المطلوبة للإصدار V3
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Encoders\AutoEncoder;

class Upload
{
    /**
     * رفع ملف واحد (صورة أو ملف عام)
     * مع تحويل الصور تلقائياً لصيغة Webp
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param bool $private
     * @return string
     */
    public static function uploadFile($file, $path, $private = false)
    {
        $disk = $private ? config('filesystems.default') : 'public';

        // التحقق إذا كان الملف صورة لمعالجته بـ Intervention Image
        if (in_array($file->getClientMimeType(), ['image/jpeg', 'image/jpg', 'image/webp', 'image/png'])) {
            $name = time() . '_' . rand(1000, 10000) . '.webp';

            // في V3 نستخدم read() بدلاً من make()
            // ونستخدم encode() مع تمرير كائن المشفر الجديد
            $imgFile = Image::read($file->getRealPath())->encode(new WebpEncoder(quality: 80));
        } else {
            // للملفات العادية (PDF, Word, etc.)
            $name = time() . '_' . rand(1000, 10000) . '.' . $file->extension();
            $imgFile = File::get($file);
        }

        $fullPath = trim($path, '/') . '/' . $name;

        // تحويل كائن الصورة إلى string عند الحفظ في الـ Storage
        Storage::disk($disk)->put($fullPath, (string) $imgFile);

        return $private ? $fullPath : Storage::disk($disk)->url($fullPath);
    }

    /**
     * رفع ملفات متعددة
     */
    public static function uploadFiles($files, $path, $private = false)
    {
        $filesName = [];
        foreach ($files as $file) {
            $filesName[] = self::uploadFile($file, $path, $private);
        }
        return $filesName;
    }

    /**
     * حفظ صورة من رابط URL مع إضافة علامة مائية (Watermark)
     */
    public static function storeUrlImage($url, $path, $private = false)
    {
        $disk = $private ? config('filesystems.default') : 'public';
        $name = time() . '_' . rand(1000, 10000) . '.png';
        $fullPath = trim($path, '/') . '/' . $name;

        // في V3 نستخدم place() بدلاً من insert() للـ Watermark
        $imgFile = Image::read(file_get_contents($url))
            ->place(public_path('watermark.png'), 'bottom-right', 10, 10)
            ->encode(new AutoEncoder());

        Storage::disk($disk)->put($fullPath, (string) $imgFile);

        return $private ? $fullPath : Storage::disk($disk)->url($fullPath);
    }

    /**
     * حذف ملف واحد
     */
    public static function deleteImage($path, $private = false)
    {
        $disk = $private ? config('filesystems.default') : 'public';

        // إذا كان الرابط URL كاملاً، نستخرج المسار النسبي منه
        if (!$private && filter_var($path, FILTER_VALIDATE_URL)) {
            $baseUrl = Storage::disk('public')->url('');
            $path = str_replace($baseUrl, '', $path);
        }

        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }

    /**
     * حذف ملفات متعددة
     */
    public static function deleteImages(array $paths, $private = false)
    {
        foreach ($paths as $path) {
            self::deleteImage($path, $private);
        }
    }

    /**
     * توليد رابط الصورة الصحيح
     */
    public static function imageUrl($path)
    {
        if (!$path) {
            return null;
        }

        // لو URL كامل
        if (Str::startsWith($path, 'http')) {
            return str_replace('/storage/', '/uploads/', $path);
        }

        // لو path نسبي
        return url(ltrim($path, '/'));
    }
}
