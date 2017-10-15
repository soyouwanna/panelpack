<?php
namespace Decoweb\Panelpack\Helpers\Contracts;

interface PicturesContract
{
    public function setModel($model);
    public function getPics($howMany);
    public function recordPics($recordId);
}