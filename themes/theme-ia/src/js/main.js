/**
 * Arquivo principal de JavaScript
 * 
 * Este arquivo contém todas as funcionalidades JavaScript do tema
 */

(function($) {
  'use strict';

  // Objeto principal do tema
  const ThemeIA = {
    /**
     * Inicializa todas as funcionalidades
     */
    init: function() {
      this.setupNavigation();
      this.setupAccessibility();
      this.setupResponsive();
    },

    /**
     * Configura a navegação responsiva
     */
    setupNavigation: function() {
      const menuToggle = $('.menu-toggle');
      const mainNavigation = $('.main-navigation');

      menuToggle.on('click', function() {
        mainNavigation.toggleClass('toggled');
        
        if (mainNavigation.hasClass('toggled')) {
          menuToggle.attr('aria-expanded', 'true');
        } else {
          menuToggle.attr('aria-expanded', 'false');
        }
      });

      // Adiciona toggle para submenus em dispositivos móveis
      $('.main-navigation .menu-item-has-children > a').after('<button class="submenu-toggle"><span class="screen-reader-text">Expandir submenu</span></button>');
      
      $('.submenu-toggle').on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('toggled');
        $(this).next('.sub-menu').toggleClass('toggled');
      });
    },

    /**
     * Configura recursos de acessibilidade
     */
    setupAccessibility: function() {
      // Adiciona suporte para navegação por teclado nos menus
      $('.main-navigation').find('a').on('focus blur', function() {
        $(this).parents('li').toggleClass('focus');
      });

      // Adiciona suporte para navegação por teclado nos submenus
      $('.main-navigation .menu-item-has-children > a').on('focus', function() {
        $(this).parent().addClass('focus');
      });
    },

    /**
     * Configura comportamentos responsivos
     */
    setupResponsive: function() {
      // Adiciona classe ao body quando a página é rolada
      $(window).on('scroll', function() {
        if ($(this).scrollTop() > 50) {
          $('body').addClass('scrolled');
        } else {
          $('body').removeClass('scrolled');
        }
      });

      // Volta ao topo
      $('.back-to-top').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
          scrollTop: 0
        }, 500);
      });
    }
  };

  // Inicializa o tema quando o DOM estiver pronto
  $(document).ready(function() {
    ThemeIA.init();
  });

})(jQuery); 