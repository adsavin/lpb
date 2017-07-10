<?php

/**
 * Created by PhpStorm.
 * User: adsavin
 * Date: 06/27/2017
 * Time: 22:40
 */
namespace app\components;

use app\models\Message;
use app\models\SourceMessage;
use yii\db\Exception;
use yii\i18n\MissingTranslationEvent;

class TranslationEventHandler
{
    public static function handleMissingTranslation(MissingTranslationEvent $event)
    {
//        $event->translatedMessage = "@MISSING: {$event->category}.{$event->message} FOR LANGUAGE {$event->language} @";
        if(\Yii::$app->sourceLanguage != $event->language) {
            try {
                $exis = SourceMessage::find()->where(["message" => $event->message])->one();
                if(!isset($exis)) {
                    $s = new SourceMessage();
                    $s->message = $event->message;
                    $s->category = $event->category;
                    if (!$s->save())
                        throw new Exception(json_encode($s->errors));
                    $m = new Message();
                    $m->language = $event->language;
                    $m->id = $s->id;
                    if (!$m->save())
                        throw new Exception(json_encode($m->errors));
                }
            } catch (Exception $x) {
                print_r($x->getMessage());exit;
            }
        }
    }

}