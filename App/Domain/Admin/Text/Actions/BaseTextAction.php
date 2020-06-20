<?php

namespace App\Domain\Admin\Text\Actions;

use App\Domain\Admin\Text\Models\Text;
use App\Domain\Admin\Text\Repositories\TextRepository;
use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Pages\Models\Slug;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
use Src\Validate\form\FormValidator;

/**
 *
 */
abstract class BaseTextAction extends FormAction {
  protected Text $text;
  protected TextRepository $textRepository;
  protected Session $session;

  protected string $key;
  protected string $value;

  protected array $attributes = [];

  /**
   *
   */
  public function __construct() {
    $this->text = new Text();
    $this->textRepository = new TextRepository(
          $this->text->find($this->text->getId())
      );
    $this->session = new Session();
    $request = new Request();

    $key = $request->post('key', $this->textRepository->getKey());
    $slug = new Slug();
    $this->key = str_replace('-', '_', $slug->parse($key));
    $this->value = $request->post('value');

    $this->attributes = [
      'translation_key' => $this->key,
      'translation_value' => $this->value,
    ];
  }

  /**
   *
   */
  protected function authorize(): bool {
    $user = new User();
    if ($this->key !== $this->textRepository->getKey()
          && $user->getRights() !== User::DEVELOPER
      ) {
      $this->session->flash(
            State::FAILED,
            Translation::get('text_editing_key_not_allowed')
        );

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    $validator = new FormValidator();

    $validator->input($this->key, Translation::get('key'))->isRequired();
    $validator->input($this->value, Translation::get('value'))->isRequired();

    // If the text already exists, and the key is not changed, allow it.
    $databaseKey = $this->textRepository->getKey();
    if ($this->key === $databaseKey) {
      return $validator->handleFormValidation();
    }

    $validator->input($this->key)
      ->isUnique(
              $this->text->getByKey($this->key),
              sprintf(
                  Translation::get('text_already_exists'),
                  $this->key
              )
          );

    return $validator->handleFormValidation();
  }

}
