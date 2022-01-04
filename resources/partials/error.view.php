<?php

use System\State;

$error = session()->get(State::FAILED->value, unset: true);
if (!empty($error)) :
    ?>
        <div class="field error-field"><?= $error ?></div>
<?php endif; ?>

<?php
$message = session()->get(State::SUCCESSFUL->value, unset: true);
if (!empty($message)) :
    ?>
    <div class="field error-field"><?= $message ?></div>
<?php endif; ?>

<?php
$message = session()->get(State::FORM_VALIDATION_FAILED->value, unset: true);
if (!empty($message)) :
    ?>
    <div class="field error-field"><?= html_entities_decode($message) ?></div>
<?php endif; ?>
