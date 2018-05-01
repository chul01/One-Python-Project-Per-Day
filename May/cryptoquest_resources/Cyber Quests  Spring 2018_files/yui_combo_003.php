/* YUI 3.9.1 (build 5852) Copyright 2013 Yahoo! Inc. http://yuilibrary.com/license/ */
YUI.add("event-valuechange",function(e,t){var n="_valuechange",r="value",i,s={POLL_INTERVAL:50,TIMEOUT:1e4,_poll:function(t,r){var i=t._node,o=r.e,u=i&&i.value,a=t._data&&t._data[n],f,l;if(!i||!a){s._stopPolling(t);return}l=a.prevVal,u!==l&&(a.prevVal=u,f={_event:o,currentTarget:o&&o.currentTarget||t,newVal:u,prevVal:l,target:o&&o.target||t},e.Object.each(a.notifiers,function(e){e.fire(f)}),s._refreshTimeout(t))},_refreshTimeout:function(e,t){if(!e._node)return;var r=e.getData(n);s._stopTimeout(e),r.timeout=setTimeout(function(){s._stopPolling(e,t)},s.TIMEOUT)},_startPolling:function(t,i,o){if(!t.test("input,textarea"))return;var u=t.getData(n);u||(u={prevVal:t.get(r)},t.setData(n,u)),u.notifiers||(u.notifiers={});if(u.interval){if(!o.force){u.notifiers[e.stamp(i)]=i;return}s._stopPolling(t,i)}u.notifiers[e.stamp(i)]=i,u.interval=setInterval(function(){s._poll(t,u,o)},s.POLL_INTERVAL),s._refreshTimeout(t,i)},_stopPolling:function(t,r){if(!t._node)return;var i=t.getData(n)||{};clearInterval(i.interval),delete i.interval,s._stopTimeout(t),r?i.notifiers&&delete i.notifiers[e.stamp(r)]:i.notifiers={}},_stopTimeout:function(e){var t=e.getData(n)||{};clearTimeout(t.timeout),delete t.timeout},_onBlur:function(e,t){s._stopPolling(e.currentTarget,t)},_onFocus:function(e,t){var i=e.currentTarget,o=i.getData(n);o||(o={},i.setData(n,o)),o.prevVal=i.get(r),s._startPolling(i,t,{e:e})},_onKeyDown:function(e,t){s._startPolling(e.currentTarget,t,{e:e})},_onKeyUp:function(e,t){(e.charCode===229||e.charCode===197)&&s._startPolling(e.currentTarget,t,{e:e,force:!0})},_onMouseDown:function(e,t){s._startPolling(e.currentTarget,t,{e:e})},_onSubscribe:function(t,i,o,u){var a,f,l;f={blur:s._onBlur,focus:s._onFocus,keydown:s._onKeyDown,keyup:s._onKeyUp,mousedown:s._onMouseDown},a=o._valuechange={};if(u)a.delegated=!0,a.getNodes=function(){return t.all("input,textarea").filter(u)},a.getNodes().each(function(e){e.getData(n)||e.setData(n,{prevVal:e.get(r)})}),o._handles=e.delegate(f,t,u,null,o);else{if(!t.test("input,textarea"))return;t.getData(n)||t.setData(n,{prevVal:t.get(r)}),o._handles=t.on(f,null,null,o)}},_onUnsubscribe:function(e,t,n){var r=n._valuechange;n._handles&&n._handles.detach(),r.delegated?r.getNodes().each(function(e){s._stopPolling(e,n)}):s._stopPolling(e,n)}};i={detach:s._onUnsubscribe,on:s._onSubscribe,delegate:s._onSubscribe,detachDelegate:s._onUnsubscribe,publishConfig:{emitFacade:!0}},e.Event.define("valuechange",i),e.Event.define("valueChange",i),e.ValueChange=s},"3.9.1",{requires:["event-focus","event-synthetic"]});
/* YUI 3.9.1 (build 5852) Copyright 2013 Yahoo! Inc. http://yuilibrary.com/license/ */
YUI.add("event-tap",function(e,t){function c(t,n,r,i){n=r?n:[n.START,n.MOVE,n.END,n.CANCEL],e.Array.each(n,function(e,n,r){var i=t[e];i&&(i.detach(),t[e]=null)})}var n=e.config.doc,r=e.Event._GESTURE_MAP,i=!!n&&!!n.createTouch,s=r.start,o=r.move,u=r.end,a=r.cancel,f="tap",l={START:"Y_TAP_ON_START_HANDLE",MOVE:"Y_TAP_ON_MOVE_HANDLE",END:"Y_TAP_ON_END_HANDLE",CANCEL:"Y_TAP_ON_CANCEL_HANDLE"};e.Event.define(f,{on:function(e,t,n){t[l.START]=e.on(s,this.touchStart,this,e,t,n)},detach:function(e,t,n){c(t,l)},delegate:function(e,t,n,r){t[l.START]=e.delegate(s,function(r){this.touchStart(r,e,t,n,!0)},r,this)},detachDelegate:function(e,t,n){c(t,l)},touchStart:function(e,t,n,r,s){var f={canceled:!1};if(e.button&&e.button===3)return;if(e.touches&&e.touches.length!==1)return;f.node=s?e.currentTarget:t,i&&e.touches?f.startXY=[e.touches[0].pageX,e.touches[0].pageY]:f.startXY=[e.pageX,e.pageY],n[l.MOVE]=t.once(o,this.touchMove,this,t,n,r,s,f),n[l.END]=t.once(u,this.touchEnd,this,t,n,r,s,f),n[l.CANCEL]=t.once(a,this.touchMove,this,t,n,r,s,f)},touchMove:function(e,t,n,r,i,s){c(n,[l.MOVE,l.END,l.CANCEL],!0,s),s.cancelled=!0},touchEnd:function(e,t,n,r,s,o){var u=o.startXY,a,h;i&&e.changedTouches?(a=[e.changedTouches[0].pageX,e.changedTouches[0].pageY],h=[e.changedTouches[0].clientX,e.changedTouches[0].clientY]):(a=[e.pageX,e.pageY],h=[e.clientX,e.clientY]),c(n,[l.MOVE,l.END,l.CANCEL],!0,o),Math.abs(a[0]-u[0])===0&&Math.abs(a[1]-u[1])===0&&(e.type=f,e.pageX=a[0],e.pageY=a[1],e.clientX=h[0],e.clientY=h[1],e.currentTarget=o.node,r.fire(e))}})},"3.9.1",{requires:["node-base","event-base","event-touch","event-synthetic"]});
/* YUI 3.9.1 (build 5852) Copyright 2013 Yahoo! Inc. http://yuilibrary.com/license/ */
YUI.add("io-form",function(e,t){var n=encodeURIComponent;e.IO.stringify=function(t,n){n=n||{};var r=e.IO.prototype._serialize({id:t,useDisabled:n.useDisabled},n.extra&&typeof n.extra=="object"?e.QueryString.stringify(n.extra):n.extra);return r},e.mix(e.IO.prototype,{_serialize:function(t,r){var i=[],s=t.useDisabled||!1,o=0,u=typeof t.id=="string"?t.id:t.id.getAttribute("id"),a,f,l,c,h,p,d,v,m,g;u||(u=e.guid("io:"),t.id.setAttribute("id",u)),f=e.config.doc.getElementById(u);if(!f||!f.elements)return r||"";for(p=0,d=f.elements.length;p<d;++p){a=f.elements[p],h=a.disabled,l=a.name;if(s?l:l&&!h){l=n(l)+"=",c=n(a.value);switch(a.type){case"select-one":a.selectedIndex>-1&&(g=a.options[a.selectedIndex],i[o++]=l+n(g.attributes.value&&g.attributes.value.specified?g.value:g.text));break;case"select-multiple":if(a.selectedIndex>-1)for(v=a.selectedIndex,m=a.options.length;v<m;++v)g=a.options[v],g.selected&&(i[o++]=l+n(g.attributes.value&&g.attributes.value.specified?g.value:g.text));break;case"radio":case"checkbox":a.checked&&(i[o++]=l+c);break;case"file":case undefined:case"reset":case"button":break;case"submit":default:i[o++]=l+c}}}return r&&(i[o++]=r),i.join("&")}},!0)},"3.9.1",{requires:["io-base","node-base"]});
YUI.add("moodle-mod_quiz-autosave",function(e,t){M.mod_quiz=M.mod_quiz||{},M.mod_quiz.autosave={TINYMCE_DETECTION_DELAY:500,TINYMCE_DETECTION_REPEATS:20,WATCH_HIDDEN_DELAY:1e3,FAILURES_BEFORE_NOTIFY:1,FIRST_SUCCESSFUL_SAVE:-1,SELECTORS:{QUIZ_FORM:"#responseform",VALUE_CHANGE_ELEMENTS:"input, textarea",CHANGE_ELEMENTS:"input, select",HIDDEN_INPUTS:"input[type=hidden]",CONNECTION_ERROR:"#connection-error",CONNECTION_OK:"#connection-ok"},AUTOSAVE_HANDLER:M.cfg.wwwroot+"/mod/quiz/autosave.ajax.php",delay:12e4,form:null,dirty:!1,delay_timer:null,save_transaction:null,savefailures:0,editor_change_handler:null,hidden_field_values:{},init:function(t){this.form=e.one(this.SELECTORS.QUIZ_FORM);if(!this.form)return;this.delay=t*1e3,this.form.delegate("valuechange",this.value_changed,this.SELECTORS.VALUE_CHANGE_ELEMENTS,this),this.form.delegate("change",this.value_changed,this.SELECTORS.CHANGE_ELEMENTS,this),this.form.on("submit",this.stop_autosaving,this),this.init_tinymce(this.TINYMCE_DETECTION_REPEATS),this.save_hidden_field_values(),this.watch_hidden_fields()},save_hidden_field_values:function(){this.form.all(this.SELECTORS.HIDDEN_INPUTS).each(function(e){var t=e.get("name");if(!t)return;this.hidden_field_values[t]=e.get("value")},this)},watch_hidden_fields:function(){this.detect_hidden_field_changes(),e.later(this.WATCH_HIDDEN_DELAY,this,this.watch_hidden_fields)},detect_hidden_field_changes:function(){this.form.all(this.SELECTORS.HIDDEN_INPUTS).each(function(e){var t=e.get("name"),n=e.get("value");if(!t)return;if(!(t in this.hidden_field_values)||n!==this.hidden_field_values[t])this.hidden_field_values[t]=n,this.value_changed({target:e})},this)},init_tinymce:function(t){if(typeof tinyMCE=="undefined"){t>0&&e.later(this.TINYMCE_DETECTION_DELAY,this,this.init_tinymce,[t-1]);return}this.editor_change_handler=e.bind(this.editor_changed,this),tinyMCE.onAddEditor.add(e.bind(this.init_tinymce_editor,this))},init_tinymce_editor:function(e,t){t.onChange.add(this.editor_change_handler),t.onRedo.add(this.editor_change_handler),t.onUndo.add(this.editor_change_handler),t.onKeyDown.add(this.editor_change_handler)},value_changed:function(e){if(e.target.get("name")==="thispage"||e.target.get("name")==="scrollpos"||e.target.get("name").match(/_:flagged$/))return;this.start_save_timer_if_necessary()},editor_changed:function(e){this.start_save_timer_if_necessary()},start_save_timer_if_necessary:function(){this.dirty=!0;if(this.delay_timer||this.save_transaction)return;this.start_save_timer()},start_save_timer:function(){this.cancel_delay(),this.delay_timer=e.later(this.delay,this,this.save_changes)},cancel_delay:function(){this.delay_timer&&this.delay_timer!==!0&&this.delay_timer.cancel(),this.delay_timer=null},save_changes:function(){this.cancel_delay(),this.dirty=!1;if(this.is_time_nearly_over()){this.stop_autosaving();return}typeof tinyMCE!="undefined"&&tinyMCE.triggerSave(),this.save_transaction=e.io(this.AUTOSAVE_HANDLER,{method:"POST",form:{id:this.form},on:{success:this.save_done,failure:this.save_failed},context:this})},save_done:function(){this.save_transaction=null,this.dirty&&this.start_save_timer(),this.savefailures>0?(e.one(this.SELECTORS.CONNECTION_ERROR).hide(),e.one(this.SELECTORS.CONNECTION_OK).show(),this.savefailures=this.FIRST_SUCCESSFUL_SAVE):this.savefailures===this.FIRST_SUCCESSFUL_SAVE&&(e.one(this.SELECTORS.CONNECTION_OK).hide(),this.savefailures=0)},save_failed:function(){this.save_transaction=null,this.start_save_timer(),this.savefailures=Math.max(1,this.savefailures+1),this.savefailures===this.FAILURES_BEFORE_NOTIFY&&(e.one(this.SELECTORS.CONNECTION_ERROR).show(),e.one(this.SELECTORS.CONNECTION_OK).hide())},is_time_nearly_over:function(){return M.mod_quiz.timer&&M.mod_quiz.timer.endtime&&(new Date).getTime()+2*this.delay>M.mod_quiz.timer.endtime},stop_autosaving:function(){this.cancel_delay(),this.delay_timer=!0,this.save_transaction&&this.save_transaction.abort()}}},"@VERSION@",{requires:["base","node","event","event-valuechange","node-event-delegate","io-form"]});
