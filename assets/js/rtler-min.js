
if($.oc.builder&&$.oc.builder.localizationInput){var LocalizationInput=$.oc.builder.localizationInput
LocalizationInput.prototype.buildAddLink=function(){var $container=this.getContainer()
if($container.find('a.localization-trigger').length>0){return}
var trigger=document.createElement('a')
trigger.setAttribute('class','oc-icon-plus localization-trigger')
trigger.setAttribute('href','#')
var pos=$container.position()
$(trigger).css({top:pos.top+4,left:7})
$container.append(trigger)}}
var Flyout=$.fn.flyout.Constructor
Flyout.prototype.createOverlay=function(){this.$overlay=$('<div class="flyout-overlay"/>')
var position=this.$el.offset()
this.$overlay.css({top:position.top,right:this.options.flyoutWidth})
this.$overlay.on('click',this.proxy(this.onOverlayClick))
$(document.body).on('keydown',this.proxy(this.onDocumentKeydown))
$(document.body).append(this.$overlay)}
var Scrollpad=$.fn.scrollpad.Constructor
Scrollpad.prototype.setScrollContentSize=function(){var scrollbarSize=this.getScrollbarSize()
if(this.options.direction=='vertical')
this.scrollContentElement.setAttribute('style','margin-left: -'+scrollbarSize+'px')
else
this.scrollContentElement.setAttribute('style','margin-bottom: -'+scrollbarSize+'px')}
+function($){"use strict";var Sortable=$.fn.sortable.Constructor
Sortable.prototype.onDrag=function($item,position,_super,event){if(this.cursorAdjustment){$item.css({left:position.left-$item.width(),top:position.top-this.cursorAdjustment.top})}
else{$item.css(position)}}}(window.jQuery);+function($){"use strict";var SidePanelTab=$.fn.sidePanelTab.Constructor
SidePanelTab.prototype.displaySidePanel=function(){$(document.body).addClass('display-side-panel')
this.$el.appendTo('#layout-canvas')
this.panelVisible=true
this.$el.css({right:this.sideNavWidth,top:this.mainNavHeight})
this.updatePanelPosition()
$(window).trigger('resize')}}(window.jQuery);+function($){"use strict";var VerticalMenu=function(element,toggle,options){this.body=$('body')
this.toggle=$(toggle)
this.options=options||{}
this.options=$.extend({},VerticalMenu.DEFAULTS,this.options)
this.wrapper=$(this.options.contentWrapper)
this.menuPanel=$('<div></div>').appendTo('body').addClass(this.options.collapsedMenuClass).css('width',0)
this.menuContainer=$('<div></div>').appendTo(this.menuPanel).css('display','none')
this.menuElement=$(element).clone().appendTo(this.menuContainer).css('width','auto')
var self=this
this.toggle.click(function(){if(!self.body.hasClass(self.options.bodyMenuOpenClass)){var wrapperWidth=self.wrapper.outerWidth()
self.menuElement.dragScroll('goToStart')
self.wrapper.css({'position':'absolute','min-width':self.wrapper.width(),'height':'100%'})
self.body.addClass(self.options.bodyMenuOpenClass)
self.menuContainer.css('display','block')
self.wrapper.animate({'right':self.options.menuWidth},{duration:200,queue:false})
self.menuPanel.animate({'width':self.options.menuWidth},{duration:200,queue:false,complete:function(){self.menuElement.css('width',self.options.menuWidth)}})}else{closeMenu()}
return false})
this.wrapper.click(function(){if(self.body.hasClass(self.options.bodyMenuOpenClass)){closeMenu()
return false}})
$(window).resize(function(){if(self.body.hasClass(self.options.bodyMenuOpenClass)){if($(window).width()>self.options.breakpoint){hideMenu()}}})
this.menuElement.dragScroll({vertical:true,start:function(){self.menuElement.addClass('drag')},stop:function(){self.menuElement.removeClass('drag')},scrollClassContainer:self.menuPanel,scrollMarkerContainer:self.menuContainer})
this.menuElement.on('click',function(){if(self.menuElement.hasClass('drag'))
return false})
function hideMenu(){self.body.removeClass(self.options.bodyMenuOpenClass)
self.wrapper.css({'position':'static','min-width':0,'left':0,'height':'100%'})
self.menuPanel.css('width',0)
self.menuElement.css('width','auto')
self.menuContainer.css('display','none')}
function closeMenu(){self.wrapper.animate({'right':0},{duration:200,queue:false})
self.menuPanel.animate({'width':0},{duration:200,queue:false,complete:hideMenu})
self.menuElement.animate({'width':0},{duration:200,queue:false})}}
VerticalMenu.DEFAULTS={menuWidth:250,minContentWidth:769,breakpoint:769,bodyMenuOpenClass:'mainmenu-open',collapsedMenuClass:'mainmenu-collapsed',contentWrapper:'#layout-canvas'}
var old=$.fn.verticalMenu
$.fn.verticalMenu=function(toggleSelector,option){return this.each(function(){var $this=$(this)
var data=$this.data('oc.verticalMenu')
var options=typeof option=='object'&&option
if(!data)$this.data('oc.verticalMenu',(data=new VerticalMenu(this,toggleSelector,options)))
if(typeof option=='string')data[option].call($this)})}
$.fn.verticalMenu.Constructor=VerticalMenu
$.fn.verticalMenu.noConflict=function(){$.fn.verticalMenu=old
return this}}(window.jQuery);