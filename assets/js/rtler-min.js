
if ($.oc.builder && $.oc.builder.localizationInput) {
    var LocalizationInput = $.oc.builder.localizationInput
    LocalizationInput.prototype.buildAddLink = function () {
        var $container = this.getContainer()
        if ($container.find('a.localization-trigger').length > 0) { return }
        var trigger = document.createElement('a')
        trigger.setAttribute('class', 'oc-icon-plus localization-trigger')
        trigger.setAttribute('href', '#')
        var pos = $container.position()
        $(trigger).css({ top: pos.top + 4, left: 7 })
        $container.append(trigger)
    }
}
var Flyout = $.fn.flyout.Constructor
Flyout.prototype.createOverlay = function () {
this.$overlay = $('<div class="flyout-overlay"/>')
    var position = this.$el.offset()
    this.$overlay.css({ top: position.top, right: this.options.flyoutWidth })
    this.$overlay.on('click', this.proxy(this.onOverlayClick))
    $(document.body).on('keydown', this.proxy(this.onDocumentKeydown))
    $(document.body).append(this.$overlay)
}