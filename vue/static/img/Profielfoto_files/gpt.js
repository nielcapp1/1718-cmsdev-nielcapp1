(function(){var window=this;var d=this,aa=function(){},ba=function(a){var b=typeof a;if("object"==b)if(a){if(a instanceof Array)return"array";if(a instanceof Object)return b;var c=Object.prototype.toString.call(a);if("[object Window]"==c)return"object";if("[object Array]"==c||"number"==typeof a.length&&"undefined"!=typeof a.splice&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("splice"))return"array";if("[object Function]"==c||"undefined"!=typeof a.call&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("call"))return"function"}else return"null";else if("function"==b&&"undefined"==typeof a.call)return"object";return b};var ca=function(a,b){for(var c=a.length,e="string"==typeof a?a.split(""):a,h=0;h<c;h++)h in e&&b.call(void 0,e[h],h,a)};var f=function(){this.a="";this.b=da};f.prototype.s=!0;f.prototype.j=function(){return this.a};var ea=function(a){return a instanceof f&&a.constructor===f&&a.b===da?a.a:"type_error:TrustedResourceUrl"},da={},fa=function(a){var b=new f;b.a=a;return b};var g=function(){this.l="";this.A=ha};g.prototype.s=!0;g.prototype.j=function(){return this.l};var ia=/^(?:(?:https?|mailto|ftp):|[^:/?#]*(?:[/?#]|$))/i,ha={},ja=function(a){var b=new g;b.l=a;return b};ja("about:blank");var k;a:{var ka=d.navigator;if(ka){var la=ka.userAgent;if(la){k=la;break a}}k=""};var l=function(a){l[" "](a);return a};l[" "]=aa;var r=function(){return d.googletag||(d.googletag={})};var u={1:"pagead2.googlesyndication.com",2:"pubads.g.doubleclick.net",3:"securepubads.g.doubleclick.net",173:"pubads.g.doubleclick.net",174:"securepubads.g.doubleclick.net",7:.02,10:0,13:1500,16:0,17:0,20:0,23:.001,24:200,27:.01,28:0,29:.01,33:"pagead2.googlesyndication.com",34:1,37:.01,38:.001,47:1E-4,53:"",54:0,58:1,159:1,60:0,63:0,65:.01,66:1E-5,67:0,68:0,69:.99,71:0,73:0,75:"",162:0,163:"",76:"",77:.001,78:0,88:1,79:1,81:.001,83:1E-4,85:0,87:0,89:1,90:0,91:0,96:1,97:0,99:.01,101:0,103:.01,104:"/pagead/js/rum.js",105:0,106:"1-0-14",107:"1-0-14",110:0,113:1,114:0,115:.01,116:.001,117:.01,118:.95,123:0,120:.95,124:.95,121:.01,169:.01,122:.01,125:.01,127:.001,129:0,131:"",132:0,156:.01,133:0,134:.01,135:0,137:.001,167:1,138:"",143:.001,168:1E-4,144:.001,141:1,151:0,157:.05,158:.001,164:0,150:".google.be",153:.001,179:.01,170:!1,184:.01,183:.01,152:[],171:.01,172:null,175:"21061385,21061386,21061387,21061388,21061452,21061453,21061454,21061455",178:.01,182:1E3,185:0,180:null,181:null};u[6]=function(a,b){try{for(var c=null;c!=a;c=a,a=a.parent)switch(a.location.protocol){case "https:":return!0;case "file:":return!!b;case "http:":return!1}}catch(e){}return!0}(window);u[49]=(new Date).getTime();u[36]=/^true$/.test("false");u[46]=/^true$/.test("false");u[148]=/^true$/.test("false");var v=function(){var a={},b;for(b in u)a[b]=u[b];this.a=a};v.prototype.get=function(a){return this.a[a]};v.prototype.set=function(a,b){this.a[a]=b};v.b=void 0;v.a=function(){return v.b?v.b:v.b=new v};var ma=["21060621","21060622","21060833","21060713"],na=["21061212","21061213","21061214","21061277"],oa=v.a().a,pa=r(),qa=pa._vars_,w;for(w in qa)oa[w]=qa[w];pa._vars_=oa;var ra=function(){return"170"},sa=r();sa.hasOwnProperty("getVersion")||(sa.getVersion=ra);var x=function(a){this.a=a||d.document||document};x.prototype.createElement=function(a){return this.a.createElement(String(a))};x.prototype.appendChild=function(a,b){a.appendChild(b)};var ta=function(){var a=aa;return function(){if(a){var b=a;a=null;b()}}};var ua=function(a,b){a.addEventListener?a.addEventListener("message",b,void 0):a.attachEvent&&a.attachEvent("onmessage",b)};var wa=function(){var a=d;this.b=a=void 0===a?d:a;this.B="https://securepubads.g.doubleclick.net/static/3p_cookie.html";this.a=2;this.g=[];this.o=!1;a:{var b=[d.top];a=[];for(var c=0,e;e=b[c++];){a.push(e);try{if(e.frames)for(var h=e.frames.length,m=0;m<h&&50>b.length;++m)b.push(e.frames[m])}catch(K){}}b:{try{var n=d.parent;if(n&&n!=d){var p=n;break b}}catch(K){}p=null}(h=p)&&a.unshift(h);a.unshift(d);var q;for(h=0;h<a.length;++h)try{var t=a[h],M=y(t);if(M){this.a=va(M);if(2!=this.a)break a;var N;if(N=!q){p=void 0;try{if(p=!!t&&null!=t.location.href)c:{try{l(t.foo);p=!0;break c}catch(K){}p=!1}N=p}catch(K){N=!1}}N&&(q=t)}}catch(K){}this.b=q||this.b}},z=function(a){if(2!=xa(a)){for(var b=1==xa(a),c=0;c<a.g.length;c++)try{a.g[c](b)}catch(e){}a.g=[]}},ya=function(a){var b=y(a.b);b&&2==a.a&&(a.a=va(b))},xa=function(a){ya(a);return a.a},za=function(a){var b=A;b.g.push(a);if(2!=b.a)z(b);else if(b.o||(ua(b.b,function(a){var c=y(b.b);if(c&&a.source==c&&2==b.a){switch(a.data){case "3p_cookie_yes":b.a=1;break;case "3p_cookie_no":b.a=0}z(b)}}),b.o=!0),y(b.b))z(b);else{a=(new x(b.b.document)).createElement("IFRAME");a.src=b.B;a.name="detect_3p_cookie";a.style.visibility="hidden";a.style.display="none";a.onload=function(){ya(b);z(b)};try{b.b.document.body.appendChild(a)}catch(c){}}},Aa=function(a,b){try{return!!a.frames[b]}catch(c){return!1}},y=function(a){return a.frames[l("detect_3p_cookie")]||null},va=function(a){return Aa(a,"3p_cookie_yes")?1:Aa(a,"3p_cookie_no")?0:2};var B=null;var C=function(a){var b=!1,c;return function(){b||(c=a(),b=!0);return c}}(function(){var a=d.navigator&&d.navigator.userAgent||"";a=a.toLowerCase();return-1!=a.indexOf("firefox/")||-1!=a.indexOf("chrome/")||-1!=a.indexOf("opr/")}),Ba=function(a,b){var c="script";c=void 0===c?"":c;var e=a.createElement("link");e.rel="preload";b instanceof f?b=ea(b):b instanceof g?b=b instanceof g&&b.constructor===g&&b.A===ha?b.l:"type_error:SafeUrl":(b instanceof g||(b=b.s?b.j():String(b),ia.test(b)||(b="about:invalid#zClosurez"),b=ja(b)),b=b.j());e.href=b;c&&(e.as=c);(a=a.getElementsByTagName("head")[0])&&a.appendChild(e)};var Ca=/^\.google\.(com?\.)?[a-z]{2,3}$/,Da=/\.(cn|com\.bi|do|sl)$/,Ea=function(a){return Ca.test(a)&&!Da.test(a)},D=d,A,Fa=function(a,b){a="https://"+("adservice"+b+"/adsid/integrator."+a);b=["domain="+encodeURIComponent(d.location.hostname)];E[3]>=+new Date&&b.push("adsid="+encodeURIComponent(E[1]));return a+"?"+b.join("&")},E,F,G=function(){D=d;E=D.googleToken=D.googleToken||{};var a=+new Date;E[1]&&E[3]>a&&0<E[2]||(E[1]="",E[2]=-1,E[3]=-1,E[4]="",E[6]="");F=D.googleIMState=D.googleIMState||{};Ea(F[1])||(F[1]=".google.com");"array"==ba(F[5])||(F[5]=[]);"boolean"==typeof F[6]||(F[6]=!1);"array"==ba(F[7])||(F[7]=[]);"number"==typeof F[8]||(F[8]=0)},Ga=function(a){try{a()}catch(b){d.setTimeout(function(){throw b;},0)}},Ia=function(a){"complete"==d.document.readyState||"loaded"==d.document.readyState||d.currentScript&&d.currentScript.async?Ha(3):a()},Ja=0,H={f:function(){return 0<F[8]},m:function(){F[8]++},u:function(){0<F[8]&&F[8]--},v:function(){F[8]=0},c:function(){},w:function(){return!1},i:function(){return F[5]},h:Ga},I={f:function(){return F[6]},m:function(){F[6]=!0},u:function(){F[6]=!1},v:function(){F[6]=!1},c:function(){},w:function(){return".google.com"!=F[1]&&2<++Ja},i:function(){return F[7]},h:function(a){Ia(function(){Ga(a)})}},Ha=function(a){if(1E-5>Math.random()){d.google_image_requests||(d.google_image_requests=[]);var b=d.document.createElement("img");b.src="https://pagead2.googlesyndication.com/pagead/gen_204?id=imerr&err="+a;d.google_image_requests.push(b)}};H.c=function(){if(!H.f()){var a=d.document,b=function(b){var c=Fa("js",b);Ba(a,c);b=a.createElement("script");b.type="text/javascript";b.onerror=function(){return d.processGoogleToken({},2)};c=fa(c);b.src=ea(c);try{(a.head||a.body||a.documentElement).appendChild(b),H.m()}catch(n){}},c=F[1];b(c);".google.com"!=c&&b(".google.com");b={};var e=(b.newToken="FBT",b);d.setTimeout(function(){return d.processGoogleToken(e,1)},1E3)}};I.c=function(){if(!I.f()){var a=d.document,b=Fa("sync.js",F[1]);Ba(a,b);b=b.replace(/[\W]/g,function(a){return"&#"+a.charCodeAt()+";"});var c=l("script"),e="<"+c+' src="'+b+'"></'+c+">"+("<"+c+'>processGoogleTokenSync({"newToken":"FBS"},5);</'+c+">");Ia(function(){a.write(e);I.m()})}};var Ka=function(a,b){G();var c=D.googleToken[5]||0;a&&(0!=c||E[3]>=+new Date?b.h(a):(b.i().push(a),b.c()));E[3]>=+new Date&&E[2]>=+new Date||b.c()},Ma=function(a){d.processGoogleToken=d.processGoogleToken||function(a,c){return La(H,a,c)};Ka(a,H)},Na=function(a){d.processGoogleTokenSync=d.processGoogleTokenSync||function(a,c){return La(I,a,c)};Ka(a,I)},Oa=function(a){A=A||new wa;za(function(b){b&&a()})},La=function(a,b,c){b=void 0===b?{}:b;c=void 0===c?0:c;var e=b.newToken||"",h="NT"==e,m=parseInt(b.freshLifetimeSecs||"",10),n=parseInt(b.validLifetimeSecs||"",10);h&&!n&&(n=3600);var p=b["1p_jar"]||"";b=b.pucrd||"";G();1==c?a.v():a.u();if(!e&&a.w())Ea(".google.com")&&(F[1]=".google.com"),a.c();else{var q=D.googleToken=D.googleToken||{},t=0==c&&e&&"string"==typeof e&&!h&&"number"==typeof m&&0<m&&"number"==typeof n&&0<n&&"string"==typeof p;h=h&&!a.f()&&(!(E[3]>=+new Date)||"NT"==E[1]);var M=!(E[3]>=+new Date)&&0!=c;if(t||h||M)h=+new Date,m=h+1E3*m,n=h+1E3*n,Ha(c),q[5]=c,q[1]=e,q[2]=m,q[3]=n,q[4]=p,q[6]=b,G();if(t||!a.f()){c=a.i();for(e=0;e<c.length;e++)a.h(c[e]);c.length=0}}};var Pa=function(){var a=J;if(!a.google_ltobserver){var b=new a.PerformanceObserver(function(b){var c=a.google_lt_queue=a.google_lt_queue||[];ca(b.getEntries(),function(a){return c.push(a)})});b.observe({entryTypes:["longtask"]});a.google_ltobserver=b}};l("partner.googleadservices.com");var Qa=l("www.googletagservices.com"),L=!1,Ra=function(a){var b=O.createElement("link");b.rel="preconnect";b.href=P+"//"+Q;a.appendChild(b)},Sa=!1,P="",Q="",R={},Ta=(R["21061282"]="/gpt/pubads_impl_nr_c_",R["21061283"]="/gpt/pubads_impl_nr_",R["21061289"]="/gpt/pubads_impl_moa_c_",R["21061290"]="/gpt/pubads_impl_moa_e_",R),Ua=v.a().get(46)&&!v.a().get(6);P=Ua?"http:":"https:";Q=v.a().get(Ua?2:3);var Wa=function(){var a=Va.getElementsByTagName("script");if(a)for(var b=0;b<a.length;b++)if(-1<a[b].src.indexOf(Qa+"/tag/js/gpt"))return a[b];return null},Ya=function(){switch(Xa){case "21060833":var a=ta();Oa(a);Ma(a);break;case "21060622":case "21060713":case "21061149":Ma(null)}},S=function(a,b){if(null===B){B="";try{var c="";try{c=d.top.location.hash}catch(m){c=d.location.hash}if(c){var e=c.match(/\bdeid=([\d,]+)/);B=e?e[1]:""}}catch(m){}}if(c=(c=B)&&c.match(new RegExp("\\b("+a.join("|")+")\\b")))a=c[0];else if(b)a:{if(!(1E-4>Math.random())&&(c=Math.random(),c<a.length*b)){try{var h=new Uint32Array(1);d.crypto.getRandomValues(h);c=h[0]/65536/65536}catch(m){c=Math.random()}a=a[Math.floor(c*a.length)];break a}a=null}else a=null;return a};var T=r(),J=T.fifWin||window,O=J.document,Za=[],$a=r();$a.hasOwnProperty("cmd")||($a.cmd=Za);if(T.evalScripts)T.evalScripts();else{switch(S(na,v.a().get(178))){case "21061213":Sa=!0;break;case "21061214":L=!0;break;case "21061277":L=Sa=!0}var Xa=v.a().get(138)||S(ma,v.a().get(137))||S(["21061149"],v.a().get(167)),Va=O,ab=Xa,U=S(["21061316","21061317"],0);U&&("21061317"==U?(v.a().set(173,Qa),v.a().set(174,Qa)):v.a().set(163,U),v.a().get(152).push(U));-1!=k.indexOf("iPhone")&&v.a().set(79,0);if(ab)try{var bb=v.a().get(150);bb&&(G(),Ea(bb)&&(F[1]=bb));v.a().set(138,ab)}catch(a){}v.a().set(172,Va.currentScript||Wa());var cb=J.PerformanceObserver&&J.PerformanceLongTaskTiming&&S(["21061354","21061355"],0);cb&&v.a().get(152).push(cb);"21061355"==cb&&Pa();var db=J.performance;if(db&&db.now){var eb=db.now();(J.google_js_reporting_queue=J.google_js_reporting_queue||[]).push({label:"1",type:9,value:eb,uniqueId:"rt."+Math.random()})}var fb;var V=v.a(),W=V.get(76);if(W)fb=W;else{var X,gb="/gpt/pubads_impl_",hb=!1;V.get(131)?X="170":hb=!0;X=X||"170";if(hb){var ib=S(["21061282","21061283"],0),jb=S(["21061289","21061290"],.05);ib?(V.get(152).push(ib),X=20171025,gb=Ta[ib]):jb&&(V.get(152).push(jb),X=20171107,gb=Ta[jb])}W=P+"//"+Q+gb+X+".js";v.a().set(76,W);fb=W}var Y=fb,kb=O,lb=kb.currentScript;if(!("complete"==kb.readyState||"loaded"==kb.readyState||lb&&lb.async)){var mb="gpt-impl-"+Math.random();try{var nb='<script id="'+mb+'" src="'+Y+'">\x3c/script>';L&&C()&&(nb+='<link rel="preconnect" href="'+P+"//"+Q+'">');O.write(nb);T._syncTagged_=!0}catch(a){}if(O.getElementById(mb))switch(T._loadStarted_=!0,Xa){case "21060833":var ob=ta();Oa(ob);Na(ob);break;case "21060622":case "21060713":case "21061149":Na(null)}}var pb=!T._loadStarted_&&!T.fifWin&&S(["21061368","21061369"],0);pb&&v.a().get(152).push(pb);if("21061369"===pb){Ya();var Z=O.createElement("iframe");Z.src="javascript:false";Z.style.display="none";Z.width=0;Z.height=0;var qb=O.head||O.body||O.documentElement;qb.appendChild(Z);var rb='<link rel=preload as=script href="'+Y+'">\n<script>googletag=window.parent.googletag;googletag.fifWin=window;\x3c/script>\n<script src="'+Y+'">\x3c/script>',sb=Z.contentWindow.document;sb.open();sb.write(rb);sb.close();L&&C()&&Ra(qb);T._loadStarted_=!0}else if(!T._loadStarted_){Ya();Sa&&Ba(O,Y);var tb=O.createElement("script");tb.src=Y;tb.async=!0;var ub=O.head||O.body||O.documentElement;ub.appendChild(tb);L&&C()&&Ra(ub);T._loadStarted_=!0}};}).call(this.googletag&&googletag.fifWin?googletag.fifWin.parent:this)
