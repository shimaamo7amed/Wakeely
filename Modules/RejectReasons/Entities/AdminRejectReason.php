<?php
namespace Modules\RejectReasons\Entities;
use Illuminate\Database\Eloquent\Model;
class AdminRejectReason extends Model
{
    protected $table = 'lawyer_rejection_pivot';

    protected $fillable = [
        'lawyer_id',
        'reject_reason_id',
        'custom_comment',
    ];
}