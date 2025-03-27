<?php
/**
 * Registra todos os hooks do plugin.
 *
 * @package WP_Components
 */

// Se este arquivo for chamado diretamente, aborte.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe responsável por registrar todos os hooks do plugin.
 */
class WP_Components_Loader {

    /**
     * Array de ações registradas com WordPress.
     *
     * @var array
     */
    protected $actions;

    /**
     * Array de filtros registrados com WordPress.
     *
     * @var array
     */
    protected $filters;

    /**
     * Inicializa as coleções usadas para manter as ações e filtros.
     */
    public function __construct() {
        $this->actions = array();
        $this->filters = array();
    }

    /**
     * Adiciona uma nova ação ao array de ações registradas.
     *
     * @param string $hook          O nome da ação WordPress que está sendo registrada.
     * @param object $component     Uma referência ao objeto no qual a ação é definida.
     * @param string $callback      O nome da função definida no $component.
     * @param int    $priority      Opcional. A prioridade em que a função deve ser executada. Padrão 10.
     * @param int    $accepted_args Opcional. O número de argumentos que a função aceita. Padrão 1.
     */
    public function add_action($hook, $component, $callback, $priority = 10, $accepted_args = 1) {
        $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * Adiciona um novo filtro ao array de filtros registrados.
     *
     * @param string $hook          O nome do filtro WordPress que está sendo registrado.
     * @param object $component     Uma referência ao objeto no qual o filtro é definido.
     * @param string $callback      O nome da função definida no $component.
     * @param int    $priority      Opcional. A prioridade em que a função deve ser executada. Padrão 10.
     * @param int    $accepted_args Opcional. O número de argumentos que a função aceita. Padrão 1.
     */
    public function add_filter($hook, $component, $callback, $priority = 10, $accepted_args = 1) {
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * Método utilitário que é usado para registrar as ações e hooks em uma única coleção.
     *
     * @param array  $hooks         A coleção de hooks que está sendo registrada (ações ou filtros).
     * @param string $hook          O nome do filtro WordPress que está sendo registrado.
     * @param object $component     Uma referência ao objeto no qual o filtro é definido.
     * @param string $callback      O nome da função definida no $component.
     * @param int    $priority      A prioridade em que a função deve ser executada.
     * @param int    $accepted_args O número de argumentos que a função aceita.
     * @return array A coleção de ações e filtros registrados com WordPress.
     */
    private function add($hooks, $hook, $component, $callback, $priority, $accepted_args) {
        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args,
        );

        return $hooks;
    }

    /**
     * Registra os filtros e ações com WordPress.
     */
    public function run() {
        foreach ($this->filters as $hook) {
            add_filter(
                $hook['hook'],
                array($hook['component'], $hook['callback']),
                $hook['priority'],
                $hook['accepted_args']
            );
        }

        foreach ($this->actions as $hook) {
            add_action(
                $hook['hook'],
                array($hook['component'], $hook['callback']),
                $hook['priority'],
                $hook['accepted_args']
            );
        }
    }
} 