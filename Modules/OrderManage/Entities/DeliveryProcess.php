<?php

namespace Modules\OrderManage\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralSetting\Entities\EmailTemplate;
use Spatie\Translatable\HasTranslations;

class DeliveryProcess extends Model
{
    use HasFactory, HasTranslations;
    protected $table = "delivery_processes";
    protected $guarded = ['id'];
    protected $appends = ['translateName','TranslateDescription'];
    public $translatable = ['name','description'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

    }
    public function getTranslateNameAttribute(){
        return $this->attributes['name'];
    }
    public function getTranslateDescriptionAttribute(){
        return $this->attributes['description'];
    }
    public function email_templates()
    {
        return $this->morphMany(EmailTemplate::class, 'relatable');
    }
}
