<?php
namespace Core;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller {
    protected $twig;

    public function __construct() {
        $loader = new FilesystemLoader(__DIR__ . '/../app/Views');
        $this->twig = new Environment($loader, [
            'cache' => __DIR__ . '/../cache',
            'debug' => true,
            'auto_reload' => true
        ]);

        // Ajout de fonctions globales
        $this->twig->addGlobal('session', $_SESSION ?? []);
        $this->twig->addGlobal('current_url', $_SERVER['REQUEST_URI'] ?? '/');
    }

    protected function view(string $view, array $data = []): void {
        try {
            echo $this->twig->render($view . '.twig', $data);
        } catch (\Exception $e) {
            // Log l'erreur
            error_log($e->getMessage());
            // Afficher une page d'erreur
            echo $this->twig->render('errors/500.twig', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function addFlash(string $type, string $message): void {
        if (!isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }
        $_SESSION['flash'][$type][] = $message;
    }

    protected function redirect(string $url): void {
        header("Location: $url");
        exit;
    }
}