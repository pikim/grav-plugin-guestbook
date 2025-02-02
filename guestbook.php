<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Events\FlexRegisterEvent;

/**
 * Class GuestbookPlugin
 * @package Grav\Plugin
 */
class GuestbookPlugin extends Plugin
{
    public $features = [
        'blueprints' => 0,
    ];

    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized'         => [['onPluginsInitialized', 0]],
            FlexRegisterEvent::class       => [['onRegisterFlex', 0]],
            'onFormProcessed'              => [['onFormProcessed', 0]],
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main events we are interested in
        $this->enable([
            // Put your main events here
        ]);
    }

    public function onRegisterFlex($event): void
    {
        $flex = $event->flex;

        $flex->addDirectoryType(
            'guestbook',
            'blueprints://flex-objects/guestbook.yaml'
        );
    }

    /**
     * Handle form processing instructions.
     *
     * @param $event
     */
    public function onFormProcessed($event): void
    {
        if (!$this->active) {
            return;
        }

        /** @var Form $form */
        $form = $event['form'];
        $action = $event['action'];
        $params = $event['params'];

        switch ($action) {
            case 'jsonAddGuestbookEntry':
                $operation = $params['operation'] ?? 'add';

                if ($operation === 'add') {
                    /** @var Flex */
                    $flex = $this->grav['flex'];
                    /** @var FlexDirectory */
                    $dir = $flex->getDirectory('guestbook');

                    /** @var FlexObjectInterface */
                    $object = $dir->createObject([
                        'author' => $form->data['author'],
                        'email' => $form->data['email'],
                        'date' => $form->data['date'],
                        'text' => $form->data['text'],
                        'moderated' => 0,
                    ]);
                    $object->save();
                }
                break;
        }
    }
}
