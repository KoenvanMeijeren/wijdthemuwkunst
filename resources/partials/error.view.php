<?php

use System\StateInterface;

$error = session()->get(StateInterface::FAILED, unset: true);
if (!empty($error)) :
    ?>
        <div class="field error-field"><?= $error ?></div>
<?php endif; ?>

<?php
$message = session()->get(StateInterface::SUCCESSFUL, unset: true);
if (!empty($message)) :
    ?>
    <div class="field error-field"><?= $message ?></div>
<?php endif; ?>

<?php
$message = session()->get(StateInterface::FORM_VALIDATION_FAILED, unset: true);
if (!empty($message)) :
    ?>
    <div class="field error-field"><?= html_entities_decode($message) ?></div>
<?php endif; ?>
