/**
 * WP Components - JavaScript principal
 * 
 * Este arquivo contém todas as funcionalidades JavaScript dos componentes
 */

(function($) {
    'use strict';

    // Objeto principal dos componentes
    const WPComponents = {
        /**
         * Inicializa todos os componentes
         */
        init: function() {
            this.initTabs();
            this.initAccordion();
            this.initAlerts();
            this.initModals();
            this.initChips();
            this.initBadges();
        },

        /**
         * Inicialização das tabs
         */
        initTabs: function() {
            $('.wp-component-tabs__link').on('click', function(e) {
                e.preventDefault();
                
                var $this = $(this);
                var target = $this.attr('href');
                
                // Remover classe active de todas as tabs e painéis
                $this.closest('.wp-component-tabs').find('.wp-component-tabs__link').removeClass('active');
                $this.closest('.wp-component-tabs').find('.wp-component-tabs__pane').removeClass('active');
                
                // Adicionar classe active à tab clicada e ao painel correspondente
                $this.addClass('active');
                $(target).addClass('active');
            });
        },

        /**
         * Inicialização do accordion
         */
        initAccordion: function() {
            $('.wp-component-accordion__button').on('click', function() {
                var $this = $(this);
                var $collapse = $this.closest('.wp-component-accordion__item').find('.wp-component-accordion__collapse');
                var isOpen = $collapse.hasClass('show');
                
                // Fechar todos os painéis
                if ($this.closest('.wp-component-accordion').data('allow-multiple') !== true) {
                    $this.closest('.wp-component-accordion').find('.wp-component-accordion__collapse').removeClass('show');
                    $this.closest('.wp-component-accordion').find('.wp-component-accordion__button').addClass('collapsed');
                }
                
                // Alternar o painel atual
                if (isOpen) {
                    $collapse.removeClass('show');
                    $this.addClass('collapsed');
                } else {
                    $collapse.addClass('show');
                    $this.removeClass('collapsed');
                }
            });
        },

        /**
         * Inicialização dos alertas
         */
        initAlerts: function() {
            $('.wp-component-alert__close').on('click', function() {
                $(this).closest('.wp-component-alert').fadeOut(300, function() {
                    $(this).remove();
                });
            });
        },

        /**
         * Inicialização dos modais
         */
        initModals: function() {
            // Abrir modal ao clicar no gatilho
            $('[data-modal-target]').on('click', function(e) {
                e.preventDefault();
                var targetId = $(this).data('modal-target');
                $('#' + targetId).addClass('show');
            });
            
            // Fechar modal ao clicar no botão de fechar
            $('[data-modal-dismiss]').on('click', function() {
                $(this).closest('.wp-component-modal').removeClass('show');
            });
            
            // Fechar modal ao clicar fora do conteúdo
            $('.wp-component-modal').on('click', function(e) {
                if ($(e.target).hasClass('wp-component-modal')) {
                    $(this).removeClass('show');
                }
            });
            
            // Fechar modal com a tecla ESC
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && $('.wp-component-modal.show').length) {
                    $('.wp-component-modal.show').removeClass('show');
                }
            });
            
            // Fechar modal ao clicar em elementos com a classe wp-component-modal-close
            $('.wp-component-modal-close').on('click', function() {
                $(this).closest('.wp-component-modal').removeClass('show');
            });
        },

        /**
         * Inicialização dos chips
         */
        initChips: function() {
            // Lidar com o clique no botão de deletar
            $('.wp-component-chip__delete').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                var $chip = $(this).closest('.wp-component-chip');
                
                // Disparar evento antes de remover
                $chip.trigger('chip:delete');
                
                // Remover o chip com animação
                $chip.animate({
                    opacity: 0,
                    width: 0,
                    marginRight: 0,
                    marginLeft: 0,
                    paddingRight: 0,
                    paddingLeft: 0
                }, 200, function() {
                    $(this).remove();
                    // Disparar evento após remover
                    $(document).trigger('chip:deleted');
                });
            });
        },

        /**
         * Inicialização dos badges
         */
        initBadges: function() {
            // Funcionalidade futura para badges interativos
        }
    };

    // Inicializar quando o documento estiver pronto
    $(document).ready(function() {
        WPComponents.init();
    });

})(jQuery); 