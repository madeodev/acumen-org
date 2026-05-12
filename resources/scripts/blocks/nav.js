export default (isMobileNav = false) => {
  return {
    openNavMenu: null,
    isNaveMenuOpen: false,
    mobileNavOpen: false,

    staggerOpenMenu(menuItem) {
      if (this.openNavMenu) {
        this.closeMenu();
        setTimeout(() => {
          this.openMenu(menuItem);
        }, 200);
      } else {
        this.openMenu(menuItem);
      }
    },

    toggleMobileNav() {
      if (this.mobileNavOpen == false) {
        this.openMobileNav();
      } else {
        this.closeMobileNav();
      }
    },

    openMobileNav() {
      this.$refs.mobileNav.classList.remove('hidden');
      this.$nextTick(() => {
        this.isNaveMenuOpen = true;
        this.mobileNavOpen = true;
        document.body.classList.add('overflow-hidden');
      });
    },

    closeMobileNav() {
      this.mobileNavOpen = false;
      this.isNaveMenuOpen = false;

      document.body.classList.remove('overflow-hidden');
      // Hide nav after animating it closed
      setTimeout(() => {
        this.$refs.mobileNav.classList.add('hidden');
      }, 301);
    },

    openMenu(menuItem) {
      this.openNavMenu = menuItem;
      if (isMobileNav) return;
      document.body.classList.add('overflow-hidden');
      document.getElementById('overlay').classList.remove('hidden');
    },

    closeMenu() {
      this.openNavMenu = null;
      if (isMobileNav) return;
      document.body.classList.remove('overflow-hidden');
      document.getElementById('overlay').classList.add('hidden');
    },

    toggleMenu(menuItem) {
      if (this.isOpen(menuItem)) {
        this.closeMenu();
      } else {
        this.staggerOpenMenu(menuItem);
      }
    },

    isOpen(menuItem) {
      return menuItem == this.openNavMenu;
    },

    handleFocusOut(button) {
      this.$nextTick(() => {
        if (document.activeElement == this.$refs[button]) return;
        if (!this.$el.contains(document.activeElement)) this.closeMenu();
      });
    },

    clickOutside(menuItem) {
      this.$nextTick(() => {
        if (this.openNavMenu && !this.isOpen(menuItem)) return;
        this.closeMenu();
      });
    },

    handleWindowResize() {
      if (window.outerWidth >= 1280 && this.mobileNavOpen) {
        this.closeMobileNav();
      }
    },

    handleEscape() {
      if (this.openNavMenu) {
        this.closeMenu();
      } else if (isMobileNav) {
        this.closeMobileNav();
      }
    },
  };
};
