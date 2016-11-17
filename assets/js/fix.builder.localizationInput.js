if ($.oc.builder && $.oc.builder.localizationInput) {
    var LocalizationInput = $.oc.builder.localizationInput
    LocalizationInput.prototype.buildAddLink = function () {
        var $container = this.getContainer()

        if ($container.find('a.localization-trigger').length > 0) {
            return
        }

        var trigger = document.createElement('a')

        trigger.setAttribute('class', 'oc-icon-plus localization-trigger')
        trigger.setAttribute('href', '#')

        var pos = $container.position()
        $(trigger).css({
            top: pos.top + 4,
            left: 7
        })

        $container.append(trigger)
    }
}