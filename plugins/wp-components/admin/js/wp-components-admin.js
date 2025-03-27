/**
 * JavaScript para a área administrativa do plugin WP Components
 */

(function($) {
    'use strict';

    // Objeto principal
    const WPComponentsAdmin = {
        /**
         * Inicializa todas as funcionalidades
         */
        init: function() {
            this.setupTabs();
            this.setupCopyCode();
            this.setupColorPicker();
        },

        /**
         * Inicializa as abas na página de configurações
         */
        setupTabs: function() {
            $('.wp-components-admin-tabs-nav a').on('click', function(e) {
                e.preventDefault();
                
                const $this = $(this);
                const target = $this.attr('href');
                
                // Remover classe ativa de todas as abas
                $('.wp-components-admin-tabs-nav a').removeClass('active');
                $('.wp-components-admin-tabs-content > div').removeClass('active');
                
                // Adicionar classe ativa à aba clicada
                $this.addClass('active');
                $(target).addClass('active');
                
                // Salvar a aba ativa no localStorage
                if (typeof(Storage) !== 'undefined') {
                    localStorage.setItem('wpComponentsActiveTab', target);
                }
            });
            
            // Restaurar a aba ativa do localStorage
            if (typeof(Storage) !== 'undefined') {
                const activeTab = localStorage.getItem('wpComponentsActiveTab');
                if (activeTab && $(activeTab).length) {
                    $('.wp-components-admin-tabs-nav a[href="' + activeTab + '"]').trigger('click');
                }
            }
        },

        /**
         * Inicializa a funcionalidade de copiar código
         */
        setupCopyCode: function() {
            $('.wp-components-admin-copy-code').on('click', function() {
                const $this = $(this);
                const $code = $this.siblings('code');
                const $temp = $('<textarea>');
                
                $('body').append($temp);
                $temp.val($code.text()).select();
                document.execCommand('copy');
                $temp.remove();
                
                // Feedback visual
                $this.text('Copiado!');
                setTimeout(function() {
                    $this.text('Copiar');
                }, 2000);
            });
        },

        /**
         * Inicializa o seletor de cores
         */
        setupColorPicker: function() {
            if ($.fn.wpColorPicker) {
                $('.wp-components-color-picker').wpColorPicker();
            }
        }
    };

    // Inicializar quando o DOM estiver pronto
    $(document).ready(function() {
        WPComponentsAdmin.init();
    });

})(jQuery); 