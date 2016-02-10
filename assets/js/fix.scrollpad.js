var Scrollpad = $.fn.scrollpad.Constructor
Scrollpad.prototype.setScrollContentSize = function() {
    var scrollbarSize = this.getScrollbarSize()

    if (this.options.direction == 'vertical')
        this.scrollContentElement.setAttribute('style', 'margin-left: -' + scrollbarSize + 'px')
    else
        this.scrollContentElement.setAttribute('style', 'margin-bottom: -' + scrollbarSize + 'px')
}