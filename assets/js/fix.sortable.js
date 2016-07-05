/*
 * Sortable plugin.
 *
 * Documentation: ../docs/drag-sort.md
 *
 * Require:
 *  - sortable/jquery-sortable
 */

+function ($) {
    "use strict";

    var Sortable = $.fn.sortable.Constructor

    Sortable.prototype.onDrag = function ($item, position, _super, event) {
        if (this.cursorAdjustment) {
            /*
             * Relative cursor position
             */
            $item.css({
                left: position.left - $item.width(),
                top: position.top - this.cursorAdjustment.top
            })
        }
        else {
            /*
             * Default behavior
             */
            $item.css(position)
        }
    }

}(window.jQuery);
