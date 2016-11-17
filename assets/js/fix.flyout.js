var Flyout = $.fn.flyout.Constructor
Flyout.prototype.createOverlay = function () {
    this.$overlay = $('<div class="flyout-overlay"/>')

    var position = this.$el.offset()

    this.$overlay.css({
        top: position.top,
        right: this.options.flyoutWidth
    })

    this.$overlay.on('click', this.proxy(this.onOverlayClick))
    $(document.body).on('keydown', this.proxy(this.onDocumentKeydown))

    $(document.body).append(this.$overlay)
}
