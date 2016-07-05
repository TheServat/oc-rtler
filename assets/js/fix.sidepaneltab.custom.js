/*
 * Side Panel Tabs
 */

+function ($) {
    "use strict";
    var SidePanelTab = $.fn.sidePanelTab.Constructor
    SidePanelTab.prototype.displaySidePanel = function () {
        $(document.body).addClass('display-side-panel')

        this.$el.appendTo('#layout-canvas')
        this.panelVisible = true
        this.$el.css({
            right: this.sideNavWidth,
            top: this.mainNavHeight
        })

        this.updatePanelPosition()
        $(window).trigger('resize')
    }


}(window.jQuery);
