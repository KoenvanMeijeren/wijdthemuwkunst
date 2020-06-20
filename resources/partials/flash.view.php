<?php

use Src\Session\Session;
use Src\State\State;

$session = new Session();

$error = $session->get(State::FAILED, true);
if (!empty($error)) :
    ?>
    <div data-notify="container" role="alert"
         class="col-sm-4 alert alert-danger alert-top-right shadow"
         data-notify-position="top-right">
        <button type="button" aria-hidden="true"
                class="close alert-button-center-right"
                data-dismiss="alert" data-notify="dismiss">
            <i class="fas fa-times"></i>
        </button>

        <span data-notify="message"><?= $error ?></span>
    </div>
<?php endif; ?>

<?php
$message = $session->get(State::SUCCESSFUL, true);
if (!empty($message)) :
    ?>
    <div data-notify="container" role="alert"
         class="col-sm-4 alert alert-success alert-top-right shadow"
         data-notify-position="top-right">
        <button type="button" aria-hidden="true"
                class="close alert-button-center-right"
                data-dismiss="alert" data-notify="dismiss">
            <i class="fas fa-times"></i>
        </button>

        <span data-notify="message"><?= $message ?></span>
    </div>
<?php endif; ?>

<?php
$message = $session->get(State::FORM_VALIDATION_FAILED, true);
if (!empty($message)) :
    ?>
    <div data-notify="container" role="alert"
         class="col-sm-4 alert alert-danger alert-top-right shadow"
         data-notify-position="top-right">
        <button type="button" aria-hidden="true"
                class="close alert-button-center-right"
                data-dismiss="alert" data-notify="dismiss">
            <i class="fas fa-times"></i>
        </button>

        <span data-notify="message">
            <?= parseHtmlEntities($message) ?>
        </span>
    </div>
<?php endif; ?>
