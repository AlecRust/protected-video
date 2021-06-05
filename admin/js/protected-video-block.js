!function(e){var t={};function r(i){if(t[i])return t[i].exports;var o=t[i]={i:i,l:!1,exports:{}};return e[i].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=e,r.c=t,r.d=function(e,t,i){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(r.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(i,o,function(t){return e[t]}.bind(null,o));return i},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=5)}([function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.i18n},function(e,t){e.exports=window.wp.components},function(e,t){e.exports=window.wp.blockEditor},function(e,t){e.exports=window.wp.blocks},function(e,t,r){"use strict";r.r(t);var i=r(0),o=r(1),n=r(3),c=r(2),a=r(4);function u(e){return e.indexOf("?")>-1?e.split("?")[0]:e.indexOf("/")>-1?e.split("/")[0]:e.indexOf("&")>-1?e.split("&")[0]:e}function d(e){var t=e;t=t.replace(/#t=.*$/,"");var r=/youtube:\/\/|https?:\/\/youtu\.be\/|http:\/\/y2u\.be\//g;if(r.test(t))return u(t.split(r)[1]);var i=/\/v\/|\/vi\//g;if(i.test(t))return u(t.split(i)[1]);var o=/v=|vi=/g;if(o.test(t))return u(t.split(o)[1].split("&")[0]);var n=/\/an_webp\//g;if(n.test(t))return u(t.split(n)[1]);var c=/\/embed\//g;if(c.test(t))return u(t.split(c)[1]);if(!/\/user\/([a-zA-Z0-9]*)$/g.test(t)){if(/\/user\/(?!.*videos)/g.test(t))return u(t.split("/").pop());var a=/\/attribution_link\?.*v%3D([^%&]*)(%26|&|$)/;return a.test(t)?u(t.match(a)[1]):void 0}}function s(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e)){var r=[],_n=!0,i=!1,o=void 0;try{for(var n,c=e[Symbol.iterator]();!(_n=(n=c.next()).done)&&(r.push(n.value),!t||r.length!==t);_n=!0);}catch(e){i=!0,o=e}finally{try{_n||null==c.return||c.return()}finally{if(i)throw o}}return r}}(e,t)||function(e,t){if(e){if("string"==typeof e)return l(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);return"Object"===r&&e.constructor&&(r=e.constructor.name),"Map"===r||"Set"===r?Array.from(e):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?l(e,t):void 0}}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function l(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,i=new Array(t);r<t;r++)i[r]=e[r];return i}function p(e){var t,r,i=e;if(i.indexOf("#")>-1){var o=i.split("#");i=s(o,1)[0]}if(i.indexOf("?")>-1&&-1===i.indexOf("clip_id=")){var n=i.split("?");i=s(n,1)[0]}var c=/https?:\/\/vimeo\.com\/([0-9]+)/.exec(i);if(c&&c[1])return c[1];var a=["https?://player.vimeo.com/video/[0-9]+$","https?://vimeo.com/channels","groups","album"].join("|");return new RegExp(a,"gim").test(i)?(r=i.split("/"))&&r.length&&(t=r.pop()):/clip_id=/gim.test(i)&&(r=i.split("clip_id="))&&r.length&&(t=s(r[1].split("&"),1)[0]),t}function v(e){var t=/https:\/\/vine\.co\/v\/([a-zA-Z0-9]*)\/?/.exec(e);return t&&t[1]}function f(e){var t;if(e.indexOf("embed")>-1)return t=/embed\/(\w{8})/,e.match(t)[1];t=/\/v\/(\w{8})/;var r=e.match(t);return r&&r.length>0?e.match(t)[1]:void 0}function m(e){var t=(e.indexOf("embed")>-1?/https:\/\/web\.microsoftstream\.com\/embed\/video\/([a-zA-Z0-9-]*)\/?/:/https:\/\/web\.microsoftstream\.com\/video\/([a-zA-Z0-9-]*)\/?/).exec(e);return t&&t[1]}Object(a.registerBlockType)("protected-video/protected-video",{title:Object(o.__)("Protected Video","protected-video"),description:Object(o.__)("YouTube/Vimeo player with disabled access to the original video.","protected-video"),icon:"lock",category:"embed",attributes:{videoUrl:{type:"string"},videoId:{type:"string"},videoService:{type:"string"}},edit({attributes:e,setAttributes:t}){const{videoUrl:r,videoId:a,videoService:u}=e;return Object(i.createElement)(i.Fragment,null,Object(i.createElement)(c.Placeholder,{icon:Object(i.createElement)(n.BlockIcon,{icon:"lock"}),label:Object(o.__)("Protected Video","protected-video"),className:"wp-block-protected-video",instructions:Object(o.__)("Paste a link to a YouTube or Vimeo video you want to display in a protected player.","protected-video")},Object(i.createElement)(c.TextControl,{label:Object(o.__)("YouTube or Vimeo URL","protected-video"),value:r,onChange:function(e){const r=function(e){if("string"!=typeof e)throw new TypeError("get-video-id expects a string");var t=e;/<iframe/gi.test(t)&&(t=function(e){if("string"!=typeof e)throw new TypeError("get-src expected a string");var t=/src="(.*?)"/gm.exec(e);if(t&&t.length>=2)return t[1]}(t)),t=(t=(t=t.trim()).replace("-nocookie","")).replace("/www.","/");var r={id:null,service:null};if(/\/\/google/.test(t)){var i=t.match(/url=([^&]+)&/);i&&(t=decodeURIComponent(i[1]))}return/youtube|youtu\.be|y2u\.be|i.ytimg\./.test(t)?r={id:d(t),service:"youtube"}:/vimeo/.test(t)?r={id:p(t),service:"vimeo"}:/vine/.test(t)?r={id:v(t),service:"vine"}:/videopress/.test(t)?r={id:f(t),service:"videopress"}:/microsoftstream/.test(t)&&(r={id:m(t),service:"microsoftstream"}),r}(e);t({videoUrl:e,videoId:r.id,videoService:r.service})}}),a&&Object(i.createElement)("div",null,Object(i.createElement)("img",{src:"youtube"==u?`https://i.ytimg.com/vi/${a}/mqdefault.jpg`:"vimeo"==u?`https://i.vimeocdn.com/video/${a}_320x180`:void 0,width:"320",height:"180",alt:Object(o.__)("Video thumbnail","protected-video")}))))},save({attributes:e}){const{videoId:t,videoService:r}=e;return Object(i.createElement)("div",{className:"wp-block-protected-video","data-plyr-provider":r,"data-plyr-embed-id":t})}})}]);