<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FaqsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $faqs = [
            [
                'question_ar' => 'ما هي منصة وكيلي؟',
                'question_en' => 'What is the Wakeely platform?',
                'answer_ar'   => 'وكيلي منصة إلكترونية تقوم بتسهيل وصول الأفراد والشركات الراغبين في الحصول على خدمات قانونية إلى السادة المحامين والمستشارين القانونيين المسجلين على المنصة في مختلف المجالات القانونية.',
                'answer_en'   => 'Wakeely is an online platform that facilitates access for individuals and companies seeking legal services to lawyers and legal consultants registered on the platform across various legal fields.',
            ],
            [
                'question_ar' => 'كيف يمكنني استخدام منصة وكيلي؟',
                'question_en' => 'How can I use the Wakeely platform?',
                'answer_ar'   => "يمكنك استخدام منصة وكيلي ببساطة عبر خطوات بسيطة:\nأولاً، قم بشرح احتياجاتك القانونية.\nثم، استلم عروضاً من محامين متخصصين في المجال الذي تحتاج إليه.\nقم بمقارنة العروض المختلفة واختر المحامي المناسب.",
                'answer_en'   => "You can use the Wakeely platform simply through a few easy steps:\nFirst, explain your legal needs.\nThen, receive offers from lawyers specialized in the field you require.\nCompare the different offers and choose the most suitable lawyer.",
            ],
            [
                'question_ar' => 'هل أستطيع أن أجد محامٍ مناسب في كل المجالات القانونية؟',
                'question_en' => 'Can I find a suitable lawyer in all legal fields?',
                'answer_ar'   => 'نعم، وكيلي تسعى دائماً إلى جذب أفضل المحامين في كل المجالات القانونية التي يحتاجها الأفراد والشركات، بما في ذلك القانون الجنائي، القانون المدني، القانون التجاري، القانون الإداري، وغيرها من المجالات القانونية الأخرى.',
                'answer_en'   => 'Yes, Wakeely always strives to attract the best lawyers in all legal fields needed by individuals and companies, including criminal law, civil law, commercial law, administrative law, and other legal fields.',
            ],
            [
                'question_ar' => 'كيف يتم اختيار المحامين على منصة وكيلي؟',
                'question_en' => 'How are lawyers selected on the Wakeely platform?',
                'answer_ar'   => 'نحن نعمل على جمع شبكة من المحامين المؤهلين والمتميزين في مختلف المجالات القانونية. يتم اختيار المحامين بعناية لضمان تقديم خدمات عالية الجودة والموثوقية للمستخدمين.',
                'answer_en'   => 'We work on building a network of qualified and distinguished lawyers across various legal fields. Lawyers are carefully selected to ensure the delivery of high-quality and reliable services to users.',
            ],
            [
                'question_ar' => 'ما هي فوائد استخدام منصة وكيلي؟',
                'question_en' => 'What are the benefits of using the Wakeely platform?',
                'answer_ar'   => "استخدام منصة وكيلي يوفر للمستخدمين العديد من الفوائد، بما في ذلك:\nسهولة وسرعة في الوصول إلى خدمات قانونية محترفة.\nإمكانية مقارنة عروض المحامين واختيار الأنسب.\nتوفير خدمات عالية الجودة بأسعار تنافسية ومعقولة.",
                'answer_en'   => "Using the Wakeely platform provides users with many benefits, including:\nEase and speed in accessing professional legal services.\nThe ability to compare lawyers' offers and choose the most suitable one.\nProviding high-quality services at competitive and reasonable prices.",
            ],
            [
                'question_ar' => 'هل هناك رسوم لاستخدام منصة وكيلي؟',
                'question_en' => 'Are there fees for using the Wakeely platform?',
                'answer_ar'   => 'استخدام منصة وكيلي لاستقبال العروض من المحامين مجاني تماماً. يتم دفع الرسوم المتعلقة بخدمات المحامي مباشرة للمحامي المختار بعد قبول العرض المقدم من المحامي.',
                'answer_en'   => 'Using the Wakeely platform to receive offers from lawyers is completely free. Fees related to the lawyer\'s services are paid directly to the chosen lawyer after accepting the offer submitted by the lawyer.',
            ],
            [
                'question_ar' => 'كيف يمكنني التواصل مع وكيلي إذا كان لدي استفسار إضافي؟',
                'question_en' => 'How can I contact Wakeely if I have an additional inquiry?',
                'answer_ar'   => 'يمكنك التواصل مع فريق وكيلي من خلال البريد الإلكتروني أو طلب تواصل أو الهاتف المتاح على المنصة، حيث يكون فريق الدعم متاحاً لمساعدتك في أي استفسارات قد تكون لديك.',
                'answer_en'   => 'You can contact the Wakeely team through the email, contact request, or phone number available on the platform, where the support team is available to assist you with any inquiries you may have.',
            ],
            [
                'question_ar' => 'هل تضمن وكيلي جودة الخدمة القانونية؟',
                'question_en' => 'Does Wakeely guarantee the quality of legal services?',
                'answer_ar'   => 'من أهم أهداف منصة وكيلي حصول الأفراد والشركات على خدمات قانونية ذات جودة عالية، لذلك نحرص على أن ينضم إلينا محامون لديهم ذات الهدف، كما حرصنا على وضع معايير لضمان جودة الخدمة يجب أن يلتزم بها كل محامٍ مسجل لدينا. ويمكن الاطلاع على هذه المعايير في صفحة الشروط والأحكام.',
                'answer_en'   => 'One of the most important goals of the Wakeely platform is to ensure that individuals and companies receive high-quality legal services. We ensure that lawyers who join us share the same goal, and we have set quality assurance standards that every registered lawyer must adhere to. These standards can be viewed on the Terms and Conditions page.',
            ],
            [
                'question_ar' => 'هل يمكنني تقديم شكوى أو ملاحظة على خدمة وكيلي؟',
                'question_en' => 'Can I submit a complaint or feedback about Wakeely\'s service?',
                'answer_ar'   => 'نحن نقدر ملاحظاتك وتعليقاتك، ويمكنك التواصل معنا لتقديم أي شكوى أو ملاحظة عبر وسائل الاتصال المتاحة على المنصة. سنعمل جاهدين على حل أي مشكلة تواجهك.',
                'answer_en'   => 'We value your feedback and comments. You can contact us to submit any complaint or feedback through the communication channels available on the platform. We will work diligently to resolve any issue you face.',
            ],
        ];

        foreach ($faqs as $faq) {
            DB::table('faqs')->updateOrInsert(
                ['question_en' => $faq['question_en']],
                array_merge($faq, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ])
            );
        }
    }
}
