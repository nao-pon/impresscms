<?php

$value = $default != 'notdefined' ? $default : true;
$this->initVar($varname, icms_properties_Handler::DTYPE_INTEGER,$value, false, null, "", false, _CO_ICMS_DOIMAGE_FORM_CAPTION, '', false, true, $displayOnForm);
$this->setControl($varname, "yesno");