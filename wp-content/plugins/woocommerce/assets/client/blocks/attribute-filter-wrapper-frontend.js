(self.webpackChunkwebpackWcBlocksFrontendJsonp=self.webpackChunkwebpackWcBlocksFrontendJsonp||[]).push([[3431],{3722:(e,t,r)=>{"use strict";r.d(t,{Z:()=>o});var n=r(9196),l=r(5736),s=r(711);r(479);const o=({name:e,count:t})=>(0,n.createElement)(n.Fragment,null,e,null!==t&&Number.isFinite(t)&&(0,n.createElement)(s.Label,{label:t.toString(),screenReaderLabel:(0,l.sprintf)(/* translators: %s number of products. */ /* translators: %s number of products. */
(0,l._n)("%s product","%s products",t,"woocommerce"),t),wrapperElement:"span",wrapperProps:{className:"wc-filter-element-label-list-count"}}))},9281:(e,t,r)=>{"use strict";r.d(t,{Z:()=>l});var n=r(9196);r(1753);const l=({children:e})=>(0,n.createElement)("div",{className:"wc-block-filter-title-placeholder"},e)},390:(e,t,r)=>{"use strict";r.d(t,{Z:()=>i});var n=r(9196),l=r(5736),s=r(7608),o=r.n(s),a=r(711);r(2728);const i=({className:e,
/* translators: Reset button text for filters. */
label:t=(0,l.__)("Reset","woocommerce"),onClick:r,screenReaderLabel:s=(0,l.__)("Reset filter","woocommerce")})=>(0,n.createElement)("button",{className:o()("wc-block-components-filter-reset-button",e),onClick:r},(0,n.createElement)(a.Label,{label:t,screenReaderLabel:s}))},6977:(e,t,r)=>{"use strict";r.d(t,{Z:()=>i});var n=r(9196),l=r(5736),s=r(7608),o=r.n(s),a=r(711);r(6099);const i=({className:e,isLoading:t,disabled:r,
/* translators: Submit button text for filters. */
label:s=(0,l.__)("Apply","woocommerce"),onClick:i,screenReaderLabel:c=(0,l.__)("Apply filter","woocommerce")})=>(0,n.createElement)("button",{type:"submit",className:o()("wp-block-button__link","wc-block-filter-submit-button","wc-block-components-filter-submit-button",{"is-loading":t},e),disabled:r,onClick:i},(0,n.createElement)(a.Label,{label:s,screenReaderLabel:c}))},2045:(e,t,r)=>{"use strict";r.d(t,{Z:()=>a});var n=r(9196),l=r(1394),s=r(7608),o=r.n(s);r(9027);const a=({className:e,style:t,suggestions:r,multiple:s=!0,saveTransform:a=(e=>e.trim().replace(/\s/g,"-")),messages:i={},validateInput:c=(e=>r.includes(e)),label:u="",...d})=>(0,n.createElement)("div",{className:o()("wc-blocks-components-form-token-field-wrapper",e,{"single-selection":!s}),style:t},(0,n.createElement)(l.Z,{label:u,__experimentalExpandOnFocus:!0,__experimentalShowHowTo:!1,__experimentalValidateInput:c,saveTransform:a,maxLength:s?void 0:1,suggestions:r,messages:i,...d}))},6621:(e,t,r)=>{"use strict";r.d(t,{d:()=>d});var n=r(9307),l=r(2600),s=r(6946),o=r(4167),a=r(9530),i=r(2785),c=r(1720),u=r(7218);const d=({queryAttribute:e,queryPrices:t,queryStock:r,queryRating:d,queryState:m,isEditor:g=!1})=>{let p=(0,u.s)();p=`${p}-collection-data`;const[f]=(0,i.$p)(p),[y,b]=(0,i.kX)("calculate_attribute_counts",[],p),[v,h]=(0,i.kX)("calculate_price_range",null,p),[w,_]=(0,i.kX)("calculate_stock_status_counts",null,p),[E,S]=(0,i.kX)("calculate_rating_counts",null,p),k=(0,a.s)(e||{}),C=(0,a.s)(t),x=(0,a.s)(r),N=(0,a.s)(d);(0,n.useEffect)((()=>{"object"==typeof k&&Object.keys(k).length&&(y.find((e=>(0,s.objectHasProp)(k,"taxonomy")&&e.taxonomy===k.taxonomy))||b([...y,k]))}),[k,y,b]),(0,n.useEffect)((()=>{v!==C&&void 0!==C&&h(C)}),[C,h,v]),(0,n.useEffect)((()=>{w!==x&&void 0!==x&&_(x)}),[x,_,w]),(0,n.useEffect)((()=>{E!==N&&void 0!==N&&S(N)}),[N,S,E]);const[T,L]=(0,n.useState)(g),[R]=(0,l.Nr)(T,200);T||L(!0);const F=(0,n.useMemo)((()=>(e=>{const t=e;return Array.isArray(e.calculate_attribute_counts)&&(t.calculate_attribute_counts=(0,o.DY)(e.calculate_attribute_counts.map((({taxonomy:e,queryType:t})=>({taxonomy:e,query_type:t})))).asc(["taxonomy","query_type"])),t})(f)),[f]);return(0,c.K)({namespace:"/wc/store/v1",resourceName:"products/collection-data",query:{...m,page:void 0,per_page:void 0,orderby:void 0,order:void 0,...F},shouldSelect:R})}},1720:(e,t,r)=>{"use strict";r.d(t,{K:()=>c});var n=r(4801),l=r(9818),s=r(9307),o=r(9530),a=r(5280),i=r(6946);const c=e=>{const{namespace:t,resourceName:r,resourceValues:c=[],query:u={},shouldSelect:d=!0}=e;if(!t||!r)throw new Error("The options object must have valid values for the namespace and the resource properties.");const m=(0,s.useRef)({results:[],isLoading:!0}),g=(0,o.s)(u),p=(0,o.s)(c),f=(0,a._)(),y=(0,l.useSelect)((e=>{if(!d)return null;const l=e(n.COLLECTIONS_STORE_KEY),s=[t,r,g,p],o=l.getCollectionError(...s);if(o){if(!(0,i.isError)(o))throw new Error("TypeError: `error` object is not an instance of Error constructor");f(o)}return{results:l.getCollection(...s),isLoading:!l.hasFinishedResolution("getCollection",s)}}),[t,r,p,g,d]);return null!==y&&(m.current=y),m.current}},2785:(e,t,r)=>{"use strict";r.d(t,{$p:()=>a,kX:()=>i});var n=r(4801),l=r(9818),s=r(9307),o=(r(9127),r(7218));const a=e=>{const t=(0,o.s)();e=e||t;const r=(0,l.useSelect)((t=>t(n.QUERY_STATE_STORE_KEY).getValueForQueryContext(e,void 0)),[e]),{setValueForQueryContext:a}=(0,l.useDispatch)(n.QUERY_STATE_STORE_KEY);return[r,(0,s.useCallback)((t=>{a(e,t)}),[e,a])]},i=(e,t,r)=>{const a=(0,o.s)();r=r||a;const i=(0,l.useSelect)((l=>l(n.QUERY_STATE_STORE_KEY).getValueForQueryKey(r,e,t)),[r,e]),{setQueryValue:c}=(0,l.useDispatch)(n.QUERY_STATE_STORE_KEY);return[i,(0,s.useCallback)((t=>{c(r,e,t)}),[r,e,c])]}},7218:(e,t,r)=>{"use strict";r.d(t,{s:()=>s});var n=r(9307);const l=(0,n.createContext)("page"),s=()=>(0,n.useContext)(l);l.Provider},8161:(e,t,r)=>{"use strict";r.d(t,{D:()=>l});var n=r(9307);function l(e,t){const r=(0,n.useRef)();return(0,n.useEffect)((()=>{r.current===e||t&&!t(e,r.current)||(r.current=e)}),[e,t]),r.current}},9530:(e,t,r)=>{"use strict";r.d(t,{s:()=>o});var n=r(9307),l=r(9127),s=r.n(l);function o(e){const t=(0,n.useRef)(e);return s()(e,t.current)||(t.current=e),t.current}},947:(e,t,r)=>{"use strict";r.d(t,{F:()=>i});var n=r(7608),l=r.n(n),s=r(6946),o=r(3392),a=r(172);const i=e=>{const t=(e=>{const t=(0,s.isObject)(e)?e:{style:{}};let r=t.style;return(0,s.isString)(r)&&(r=JSON.parse(r)||{}),(0,s.isObject)(r)||(r={}),{...t,style:r}})(e),r=(0,a.vc)(t),n=(0,a.l8)(t),i=(0,a.su)(t),c=(0,o.f)(t);return{className:l()(c.className,r.className,n.className,i.className),style:{...c.style,...r.style,...n.style,...i.style}}}},5280:(e,t,r)=>{"use strict";r.d(t,{_:()=>l});var n=r(9307);const l=()=>{const[,e]=(0,n.useState)();return(0,n.useCallback)((t=>{e((()=>{throw t}))}),[])}},3392:(e,t,r)=>{"use strict";r.d(t,{f:()=>l});var n=r(6946);const l=e=>{const t=(0,n.isObject)(e.style.typography)?e.style.typography:{},r=(0,n.isString)(t.fontFamily)?t.fontFamily:"";return{className:e.fontFamily?`has-${e.fontFamily}-font-family`:r,style:{fontSize:e.fontSize?`var(--wp--preset--font-size--${e.fontSize})`:t.fontSize,fontStyle:t.fontStyle,fontWeight:t.fontWeight,letterSpacing:t.letterSpacing,lineHeight:t.lineHeight,textDecoration:t.textDecoration,textTransform:t.textTransform}}}},172:(e,t,r)=>{"use strict";r.d(t,{l8:()=>d,su:()=>m,vc:()=>u});var n=r(7608),l=r.n(n),s=r(7427),o=r(2289),a=r(6946);function i(e={}){const t={};return(0,o.getCSSRules)(e,{selector:""}).forEach((e=>{t[e.key]=e.value})),t}function c(e,t){return e&&t?`has-${(0,s.o)(t)}-${e}`:""}function u(e){var t,r,n,s,o,u,d;const{backgroundColor:m,textColor:g,gradient:p,style:f}=e,y=c("background-color",m),b=c("color",g),v=function(e){if(e)return`has-${e}-gradient-background`}(p),h=v||(null==f||null===(t=f.color)||void 0===t?void 0:t.gradient);return{className:l()(b,v,{[y]:!h&&!!y,"has-text-color":g||(null==f||null===(r=f.color)||void 0===r?void 0:r.text),"has-background":m||(null==f||null===(n=f.color)||void 0===n?void 0:n.background)||p||(null==f||null===(s=f.color)||void 0===s?void 0:s.gradient),"has-link-color":(0,a.isObject)(null==f||null===(o=f.elements)||void 0===o?void 0:o.link)?null==f||null===(u=f.elements)||void 0===u||null===(d=u.link)||void 0===d?void 0:d.color:void 0}),style:i({color:(null==f?void 0:f.color)||{}})}}function d(e){var t;const r=(null===(t=e.style)||void 0===t?void 0:t.border)||{};return{className:function(e){var t;const{borderColor:r,style:n}=e,s=r?c("border-color",r):"";return l()({"has-border-color":!!r||!(null==n||null===(t=n.border)||void 0===t||!t.color),[s]:!!s})}(e),style:i({border:r})}}function m(e){var t;return{className:void 0,style:i({spacing:(null===(t=e.style)||void 0===t?void 0:t.spacing)||{}})}}},2025:(e,t,r)=>{"use strict";r.r(t),r.d(t,{default:()=>j});var n=r(9196),l=r(7608),s=r.n(l),o=r(947),a=r(6946),i=r(5736),c=r(9530),u=r(8161),d=r(2785),m=r(1720),g=r(6621),p=r(9307),f=r(3722),y=r(390),b=r(6977),v=r(9127),h=r.n(v),w=r(2629),_=r(4617),E=r(6483),S=r(2911),k=r(7642),C=r(4534),x=r(2045),N=r(9281),T=r(9212),L=r(5833);const R=[{value:"preview-1",formattedValue:"preview-1",name:"Blue",label:(0,n.createElement)(f.Z,{name:"Blue",count:3}),textLabel:"Blue (3)"},{value:"preview-2",formattedValue:"preview-2",name:"Green",label:(0,n.createElement)(f.Z,{name:"Green",count:3}),textLabel:"Green (3)"},{value:"preview-3",formattedValue:"preview-3",name:"Red",label:(0,n.createElement)(f.Z,{name:"Red",count:2}),textLabel:"Red (2)"}],F={count:0,has_archives:!0,id:0,label:"Preview",name:"preview",order:"menu_order",parent:0,taxonomy:"preview",type:""};r(3106);const A=JSON.parse('{"Y4":{"hd":{"Z":"or"},"D8":{"Z":3},"PW":{"Z":"list"},"lr":{"Z":"multiple"}}}');function Z(){return Math.floor(Math.random()*Date.now())}const q=e=>e.replace("pa_",""),P=(e,t=[])=>{const r={};t.forEach((e=>{const{attribute:t,slug:n,operator:l}=e,s=q(t),o=n.join(","),a=`${C.zv}${s}`,i="in"===l?"or":"and";r[`${C.w8}${s}`]=o,r[a]=i}));const n=(0,E.removeQueryArgs)(e,...Object.keys(r));return(0,E.addQueryArgs)(n,r)},O=e=>{if(e){const t=(0,C.re)(`filter_${e.name}`);return("string"==typeof t?t.split(","):[]).map((e=>encodeURIComponent(e).toLowerCase()))}return[]},$=e=>e.trim().replace(/\s/g,"-").replace(/_/g,"-").replace(/-+/g,"-").replace(/[^a-zA-Z0-9-]/g,"");var I=r(711);const Q=({isLoading:e=!1,options:t,checked:r,onChange:l})=>e?(0,n.createElement)(n.Fragment,null,(0,n.createElement)("span",{className:"is-loading"}),(0,n.createElement)("span",{className:"is-loading"})):(0,n.createElement)(I.CheckboxList,{className:"wc-block-attribute-filter-list",options:t,checked:r,onChange:l,isLoading:e,isDisabled:e});var Y=r(9389);const D=({attributes:e,isEditor:t=!1,getNotice:r=(()=>null)})=>{const l=(0,_.getSettingWithCoercion)("hasFilterableProducts",!1,a.isBoolean),o=(0,_.getSettingWithCoercion)("isRenderingPhpTemplate",!1,a.isBoolean),v=(0,_.getSettingWithCoercion)("pageUrl",window.location.href,a.isString),[A,I]=(0,p.useState)(!1),D=e.isPreview&&!e.attributeId?F:(0,T.it)(e.attributeId),j=(0,p.useMemo)((()=>O(D)),[D]),[B,V]=(0,p.useState)(j),[z,U]=(0,p.useState)(Z()),[W,K]=(0,p.useState)(e.isPreview&&!e.attributeId?R:[]),[X]=(0,d.$p)(),[H,M]=(0,d.kX)("attributes",[]),{results:J,isLoading:G}=(0,m.K)({namespace:"/wc/store/v1",resourceName:"products/attributes/terms",resourceValues:[(null==D?void 0:D.id)||0],shouldSelect:e.attributeId>0,query:{orderby:"menu_order"}}),{results:ee,isLoading:te}=(0,g.d)({queryAttribute:{taxonomy:(null==D?void 0:D.taxonomy)||"",queryType:e.queryType},queryState:X,isEditor:t}),re=(0,p.useCallback)((e=>(0,a.objectHasProp)(ee,"attribute_counts")&&Array.isArray(ee.attribute_counts)?ee.attribute_counts.find((({term:t})=>t===e)):null),[ee]);(0,p.useEffect)((()=>{if(G||te)return;if(!Array.isArray(J))return;const t=J.map((t=>{const r=re(t.id);if(!(r||B.includes(t.slug)||(l=t.slug,null!=X&&X.attributes&&X.attributes.some((({attribute:e,slug:t=[]})=>e===(null==D?void 0:D.taxonomy)&&t.includes(l))))))return null;var l;const s=r?r.count:0;return{formattedValue:$(t.slug),value:t.slug,name:(0,w.decodeEntities)(t.name),label:(0,n.createElement)(f.Z,{name:(0,w.decodeEntities)(t.name),count:e.showCounts?s:null}),textLabel:e.showCounts?`${(0,w.decodeEntities)(t.name)} (${s})`:(0,w.decodeEntities)(t.name)}})).filter((e=>!!e));K(t),U(Z())}),[null==D?void 0:D.taxonomy,J,G,e.showCounts,te,re,B,X.attributes]);const ne=(0,p.useCallback)((e=>Array.isArray(J)?J.reduce(((t,r)=>(e.includes(r.slug)&&t.push(r),t)),[]):[]),[J]),le=(0,p.useCallback)(((e,t=!1)=>{if(e=e.map((e=>({...e,slug:e.slug.map((e=>decodeURIComponent(e)))}))),t){if(null==D||!D.taxonomy)return;const t=Object.keys((0,E.getQueryArgs)(window.location.href)),r=q(D.taxonomy),n=t.reduce(((e,t)=>t.includes(C.zv+r)||t.includes(C.w8+r)?(0,E.removeQueryArgs)(e,t):e),window.location.href),l=P(n,e);(0,C.X7)(l)}else{const t=P(v,e);((e,t)=>{const r=Object.entries(t).reduce(((e,[t,r])=>t.includes("query_type")?e:{...e,[t]:r}),{});return Object.entries(r).reduce(((t,[r,n])=>e[r]===n&&t),!0)})((0,E.getQueryArgs)(window.location.href),(0,E.getQueryArgs)(t))||(0,C.X7)(t)}}),[v,null==D?void 0:D.taxonomy]),se=t=>{const r=(0,L.e)(H,M,D,ne(t),"or"===e.queryType?"in":"and");le(r,0===t.length)},oe=(0,p.useCallback)(((r,n=!1)=>{t||(V(r),!n&&e.showFilterButton||(0,L.e)(H,M,D,ne(r),"or"===e.queryType?"in":"and"))}),[t,V,H,M,D,ne,e.queryType,e.showFilterButton]),ae=(0,p.useMemo)((()=>(0,a.isAttributeQueryCollection)(H)?H.filter((({attribute:e})=>e===(null==D?void 0:D.taxonomy))).flatMap((({slug:e})=>e)):[]),[H,null==D?void 0:D.taxonomy]),ie=(0,c.s)(ae),ce=(0,u.D)(ie);(0,p.useEffect)((()=>{!ce||h()(ce,ie)||h()(B,ie)||oe(ie)}),[B,ie,ce,oe]);const ue="single"!==e.selectType,de=(0,p.useCallback)((e=>{const t=B.includes(e);let r;ue?(r=B.filter((t=>t!==e)),t||(r.push(e),r.sort())):r=t?[]:[e],oe(r)}),[B,ue,oe]);(0,p.useEffect)((()=>{D&&!e.showFilterButton&&((({currentCheckedFilters:e,hasSetFilterDefaultsFromUrl:t})=>t&&0===e.length)({currentCheckedFilters:B,hasSetFilterDefaultsFromUrl:A})?le(H,!0):le(H,!1))}),[A,le,H,D,B,e.showFilterButton]),(0,p.useEffect)((()=>{if(!A&&!G)return j.length>0?(I(!0),void oe(j,!0)):void(o||I(!0))}),[D,A,G,oe,j,o]);const me=(0,Y.Ah)();if(!l)return me(!1),null;if(!D)return t?r("noAttributes"):(me(!1),null);if(0===W.length&&!G&&t)return r("noProducts");const ge=`h${e.headingLevel}`,pe=!e.isPreview&&G,fe=!e.isPreview&&te,ye=(pe||fe)&&0===W.length;if(!ye&&0===W.length)return me(!1),null;const be=ue?!ye&&B.length<W.length:!ye&&0===B.length,ve=(0,n.createElement)(ge,{className:"wc-block-attribute-filter__title"},e.heading),he=ye?(0,n.createElement)(N.Z,null,ve):ve;return me(!0),(0,n.createElement)(n.Fragment,null,!t&&e.heading&&he,(0,n.createElement)("div",{className:s()("wc-block-attribute-filter",`style-${e.displayStyle}`)},"dropdown"===e.displayStyle?(0,n.createElement)(n.Fragment,null,(0,n.createElement)(x.Z,{key:z,className:s()({"single-selection":!ue,"is-loading":ye}),suggestions:W.filter((e=>!B.includes(e.value))).map((e=>e.formattedValue)),disabled:ye,placeholder:(0,i.sprintf)(/* translators: %s attribute name. */ /* translators: %s attribute name. */
(0,i.__)("Select %s","woocommerce"),D.label),onChange:e=>{!ue&&e.length>1&&(e=[e[e.length-1]]);const t=[e=e.map((e=>{const t=W.find((t=>t.formattedValue===e));return t?t.value:e})),B].reduce(((e,t)=>e.filter((e=>!t.includes(e)))));if(1===t.length)return de(t[0]);const r=[B,e].reduce(((e,t)=>e.filter((e=>!t.includes(e)))));1===r.length&&de(r[0])},value:B,displayTransform:e=>{const t=W.find((t=>[t.value,t.formattedValue].includes(e)));return t?t.textLabel:e},saveTransform:$,messages:{added:(0,i.sprintf)(/* translators: %s is the attribute label. */ /* translators: %s is the attribute label. */
(0,i.__)("%s filter added.","woocommerce"),D.label),removed:(0,i.sprintf)(/* translators: %s is the attribute label. */ /* translators: %s is the attribute label. */
(0,i.__)("%s filter removed.","woocommerce"),D.label),remove:(0,i.sprintf)(/* translators: %s is the attribute label. */ /* translators: %s is the attribute label. */
(0,i.__)("Remove %s filter.","woocommerce"),D.label.toLocaleLowerCase()),__experimentalInvalid:(0,i.sprintf)(/* translators: %s is the attribute label. */ /* translators: %s is the attribute label. */
(0,i.__)("Invalid %s filter.","woocommerce"),D.label.toLocaleLowerCase())}}),be&&(0,n.createElement)(S.Z,{icon:k.Z,size:30})):(0,n.createElement)(Q,{options:W,checked:B,onChange:de,isLoading:ye,isDisabled:ye})),(0,n.createElement)("div",{className:"wc-block-attribute-filter__actions"},(B.length>0||t)&&!ye&&(0,n.createElement)(y.Z,{onClick:()=>{V([]),U(Z()),A&&se([])},screenReaderLabel:(0,i.__)("Reset attribute filter","woocommerce")}),e.showFilterButton&&(0,n.createElement)(b.Z,{className:"wc-block-attribute-filter__button",isLoading:ye,disabled:(()=>{if(pe||fe)return!0;const e=O(D);return e.length===B.length&&B.every((t=>e.includes(t)))})(),onClick:()=>se(B)})))},j=e=>{const t=(0,o.F)(e),r=(l=e,{className:(0,a.isString)(null==l?void 0:l.className)?l.className:"",attributeId:parseInt((0,a.isString)(null==l?void 0:l.attributeId)?l.attributeId:"0",10),showCounts:"true"===(null==l?void 0:l.showCounts),queryType:(0,a.isString)(null==l?void 0:l.queryType)&&l.queryType||A.Y4.hd.Z,heading:(0,a.isString)(null==l?void 0:l.heading)?l.heading:"",headingLevel:(0,a.isString)(null==l?void 0:l.headingLevel)&&parseInt(l.headingLevel,10)||A.Y4.D8.Z,displayStyle:(0,a.isString)(null==l?void 0:l.displayStyle)&&l.displayStyle||A.Y4.PW.Z,showFilterButton:"true"===(null==l?void 0:l.showFilterButton),selectType:(0,a.isString)(null==l?void 0:l.selectType)&&l.selectType||A.Y4.lr.Z,isPreview:!1});var l;return(0,n.createElement)("div",{className:s()((0,a.isString)(e.className)?e.className:"",t.className),style:t.style},(0,n.createElement)(D,{isEditor:!1,attributes:r}))}},5833:(e,t,r)=>{"use strict";r.d(t,{e:()=>s,o:()=>l});var n=r(4167);const l=(e=[],t,r,l="")=>{const s=e.filter((e=>e.attribute===r.taxonomy)),o=s.length?s[0]:null;if(!(o&&o.slug&&Array.isArray(o.slug)&&o.slug.includes(l)))return;const a=o.slug.filter((e=>e!==l)),i=e.filter((e=>e.attribute!==r.taxonomy));a.length>0&&(o.slug=a.sort(),i.push(o)),t((0,n.DY)(i).asc("attribute"))},s=(e=[],t,r,l=[],s="in")=>{if(!r||!r.taxonomy)return[];const o=e.filter((e=>e.attribute!==r.taxonomy));return 0===l.length?t(o):(o.push({attribute:r.taxonomy,operator:s,slug:l.map((({slug:e})=>e)).sort()}),t((0,n.DY)(o).asc("attribute"))),o}},9212:(e,t,r)=>{"use strict";r.d(t,{I3:()=>o,it:()=>s});var n=r(4617);r(6946),r(9818);const l=(0,n.getSetting)("attributes",[]).reduce(((e,t)=>{const r=(n=t)&&n.attribute_name?{id:parseInt(n.attribute_id,10),name:n.attribute_name,taxonomy:"pa_"+n.attribute_name,label:n.attribute_label}:null;var n;return r&&r.id&&e.push(r),e}),[]),s=e=>{if(e)return l.find((t=>t.id===e))},o=e=>{if(e)return l.find((t=>t.taxonomy===e))}},4534:(e,t,r)=>{"use strict";r.d(t,{H9:()=>d,X7:()=>u,re:()=>c,w8:()=>i,zv:()=>a});var n=r(6483),l=r(4617),s=r(6946);const o=(0,l.getSettingWithCoercion)("isRenderingPhpTemplate",!1,s.isBoolean),a="query_type_",i="filter_";function c(e){return window?(0,n.getQueryArg)(window.location.href,e):null}function u(e){if(o){const t=new URL(e);t.pathname=t.pathname.replace(/\/page\/[0-9]+/i,""),t.searchParams.delete("paged"),t.searchParams.forEach(((e,r)=>{r.match(/^query(?:-[0-9]+)?-page$/)&&t.searchParams.delete(r)})),window.location.href=t.href}else window.history.replaceState({},"",e)}const d=e=>{const t=(0,n.getQueryArgs)(e);return(0,n.addQueryArgs)(e,t)}},479:()=>{},1753:()=>{},2728:()=>{},6099:()=>{},9027:()=>{},3106:()=>{}}]);