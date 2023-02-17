"use strict";!function(){let o,e,t,r,a,i,s,n,l,d;isDarkStyle?(o=config.colors_dark.cardColor,e=config.colors_dark.headingColor,t=config.colors_dark.textMuted,a=config.colors_dark.borderColor,i=config.colors_dark.bodyColor,r="dark",s="#4f51c0",n="#595cd9",l="#8789ff",d="#c3c4ff"):(o=config.colors.cardColor,e=config.colors.headingColor,t=config.colors.textMuted,a=config.colors.borderColor,i=config.colors.bodyColor,r="",s="#e1e2ff",n="#c3c4ff",l="#a5a7ff",d="#696cff");const p=document.querySelector("#customerRatingsChart"),c={chart:{height:200,toolbar:{show:!1},zoom:{enabled:!1},type:"line",dropShadow:{enabled:!0,enabledOnSeries:[1],top:13,left:4,blur:3,color:config.colors.primary,opacity:.09}},series:[{name:"Last Month",data:[20,54,20,38,22,28,16,19]},{name:"This Month",data:[20,32,22,65,40,46,34,70]}],stroke:{curve:"smooth",dashArray:[8,0],width:[3,4]},legend:{show:!1},colors:[a,config.colors.primary],grid:{show:!1,borderColor:a,padding:{top:-20,bottom:-10,left:0}},markers:{size:6,colors:"transparent",strokeColors:"transparent",strokeWidth:5,hover:{size:6},discrete:[{fillColor:config.colors.white,seriesIndex:1,dataPointIndex:7,strokeColor:config.colors.primary,size:6},{fillColor:config.colors.white,seriesIndex:1,dataPointIndex:3,strokeColor:config.colors.black,size:6}]},xaxis:{labels:{style:{colors:t,fontSize:"13px"}},axisTicks:{show:!1},categories:["","Jan","Feb","Mar","Apr","May","Jun","Jul"],axisBorder:{show:!1}},yaxis:{show:!1}};if(void 0!==typeof p&&null!==p){new ApexCharts(p,c).render()}const h=document.querySelector("#salesStats"),f={chart:{height:300,type:"radialBar"},series:[75],labels:["Sales"],plotOptions:{radialBar:{startAngle:0,endAngle:360,strokeWidth:"70",hollow:{margin:50,size:"75%",image:assetsPath+"img/icons/misc/arrow-star.png",imageWidth:65,imageHeight:55,imageOffsetY:-35,imageClipped:!1},track:{strokeWidth:"50%",background:a},dataLabels:{show:!0,name:{offsetY:60,show:!0,color:i,fontSize:"15px"},value:{formatter:function(o){return parseInt(o)+"%"},offsetY:20,color:e,fontSize:"32px",show:!0}}}},fill:{type:"solid",colors:config.colors.success},stroke:{lineCap:"round"},states:{hover:{filter:{type:"none"}},active:{filter:{type:"none"}}}};if(void 0!==typeof h&&null!==h){new ApexCharts(h,f).render()}const y=document.querySelector("#salesAnalyticsChart");if(void 0!==typeof y&&null!==y){new ApexCharts(y,{chart:{height:350,type:"heatmap",parentHeightOffset:0,offsetX:-10,offsetY:-15,toolbar:{show:!1}},series:[{name:"1k",data:[{x:"Jan",y:"250"},{x:"Feb",y:"350"},{x:"Mar",y:"220"},{x:"Apr",y:"290"},{x:"May",y:"650"},{x:"Jun",y:"260"},{x:"Jul",y:"274"},{x:"Aug",y:"850"}]},{name:"2k",data:[{x:"Jan",y:"750"},{x:"Feb",y:"3350"},{x:"Mar",y:"1220"},{x:"Apr",y:"1290"},{x:"May",y:"1650"},{x:"Jun",y:"1260"},{x:"Jul",y:"1274"},{x:"Aug",y:"850"}]},{name:"3k",data:[{x:"Jan",y:"375"},{x:"Feb",y:"1350"},{x:"Mar",y:"3220"},{x:"Apr",y:"2290"},{x:"May",y:"2650"},{x:"Jun",y:"2260"},{x:"Jul",y:"1274"},{x:"Aug",y:"815"}]},{name:"4k",data:[{x:"Jan",y:"575"},{x:"Feb",y:"1350"},{x:"Mar",y:"2220"},{x:"Apr",y:"3290"},{x:"May",y:"3650"},{x:"Jun",y:"2260"},{x:"Jul",y:"1274"},{x:"Aug",y:"315"}]},{name:"5k",data:[{x:"Jan",y:"875"},{x:"Feb",y:"1350"},{x:"Mar",y:"2220"},{x:"Apr",y:"3290"},{x:"May",y:"3650"},{x:"Jun",y:"2260"},{x:"Jul",y:"1274"},{x:"Aug",y:"965"}]},{name:"6k",data:[{x:"Jan",y:"575"},{x:"Feb",y:"1350"},{x:"Mar",y:"2220"},{x:"Apr",y:"2290"},{x:"May",y:"2650"},{x:"Jun",y:"3260"},{x:"Jul",y:"1274"},{x:"Aug",y:"815"}]},{name:"7k",data:[{x:"Jan",y:"575"},{x:"Feb",y:"1350"},{x:"Mar",y:"1220"},{x:"Apr",y:"1290"},{x:"May",y:"1650"},{x:"Jun",y:"1260"},{x:"Jul",y:"3274"},{x:"Aug",y:"815"}]},{name:"8k",data:[{x:"Jan",y:"575"},{x:"Feb",y:"350"},{x:"Mar",y:"220"},{x:"Apr",y:"290"},{x:"May",y:"650"},{x:"Jun",y:"260"},{x:"Jul",y:"274"},{x:"Aug",y:"815"}]}],plotOptions:{heatmap:{enableShades:!1,radius:"6px",colorScale:{ranges:[{from:0,to:1e3,name:"1k",color:s},{from:1001,to:2e3,name:"2k",color:n},{from:2001,to:3e3,name:"3k",color:l},{from:3001,to:4e3,name:"4k",color:d}]}}},dataLabels:{enabled:!1},stroke:{width:4,colors:[o]},legend:{show:!1},grid:{show:!1,padding:{top:-15,left:10,bottom:-7}},xaxis:{labels:{show:!0,style:{colors:t,fontSize:"13px"}},axisBorder:{show:!1},axisTicks:{show:!1}},yaxis:{labels:{style:{colors:t,fontSize:"13px"}}},responsive:[{breakpoint:1441,options:{chart:{height:"325px"},grid:{padding:{right:-15}}}},{breakpoint:1045,options:{chart:{height:"300px"},grid:{padding:{right:-50}}}},{breakpoint:992,options:{chart:{height:"320px"},grid:{padding:{right:-50}}}},{breakpoint:767,options:{chart:{height:"400px"},grid:{padding:{right:0}}}},{breakpoint:568,options:{chart:{height:"330px"},grid:{padding:{right:-20}}}}],states:{hover:{filter:{type:"none"}},active:{filter:{type:"none"}}}}).render()}const g=document.querySelector("#salesActivityChart"),u={chart:{type:"bar",height:235,stacked:!0,toolbar:{show:!1}},series:[{name:"PRODUCT A",data:[75,50,55,60,48,82,59]},{name:"PRODUCT B",data:[25,29,32,35,34,18,30]}],plotOptions:{bar:{horizontal:!1,columnWidth:"40%",borderRadius:10,startingShape:"rounded",endingShape:"rounded"}},dataLabels:{enabled:!1},stroke:{curve:"smooth",width:6,lineCap:"round",colors:[o]},legend:{show:!1},colors:[config.colors.danger,"#435971"],fill:{opacity:1},grid:{show:!1,strokeDashArray:7,padding:{top:-40,left:0,right:0}},xaxis:{categories:["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],labels:{show:!0,style:{colors:t,fontSize:"13px"}},axisBorder:{show:!1},axisTicks:{show:!1}},yaxis:{show:!1},responsive:[{breakpoint:1440,options:{plotOptions:{bar:{borderRadius:10,columnWidth:"50%"}}}},{breakpoint:1300,options:{plotOptions:{bar:{borderRadius:11,columnWidth:"55%"}}}},{breakpoint:1200,options:{plotOptions:{bar:{borderRadius:10,columnWidth:"45%"}}}},{breakpoint:1040,options:{plotOptions:{bar:{borderRadius:10,columnWidth:"50%"}}}},{breakpoint:992,options:{plotOptions:{bar:{borderRadius:12,columnWidth:"40%"}},chart:{type:"bar",height:320}}},{breakpoint:768,options:{plotOptions:{bar:{borderRadius:11,columnWidth:"25%"}}}},{breakpoint:576,options:{plotOptions:{bar:{borderRadius:10,columnWidth:"35%"}}}},{breakpoint:440,options:{plotOptions:{bar:{borderRadius:10,columnWidth:"45%"}}}},{breakpoint:360,options:{plotOptions:{bar:{borderRadius:8,columnWidth:"50%"}}}}],states:{hover:{filter:{type:"none"}},active:{filter:{type:"none"}}}};if(void 0!==typeof g&&null!==g){new ApexCharts(g,u).render()}const b=document.querySelector("#totalIncomeChart"),x={chart:{height:220,type:"area",toolbar:!1,dropShadow:{enabled:!0,top:14,left:2,blur:3,color:config.colors.primary,opacity:.15}},series:[{data:[3350,3350,4800,4800,2950,2950,1800,1800,3750,3750,5700,5700]}],dataLabels:{enabled:!1},stroke:{width:3,curve:"straight"},colors:[config.colors.primary],fill:{type:"gradient",gradient:{shade:r,shadeIntensity:.8,opacityFrom:.7,opacityTo:.25,stops:[0,95,100]}},grid:{show:!0,borderColor:a,padding:{top:-15,bottom:-10,left:0,right:0}},xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],labels:{offsetX:0,style:{colors:t,fontSize:"13px"}},axisBorder:{show:!1},axisTicks:{show:!1},lines:{show:!1}},yaxis:{labels:{offsetX:-15,formatter:function(o){return"$"+parseInt(o/1e3)+"k"},style:{fontSize:"13px",colors:t}},min:1e3,max:6e3,tickAmount:5}};if(void 0!==typeof b&&null!==b){new ApexCharts(b,x).render()}const m=document.querySelector("#incomeChart"),k={series:[{data:[24,21,30,22,42,26,35,29]}],chart:{height:200,parentHeightOffset:0,parentWidthOffset:0,toolbar:{show:!1},type:"area"},dataLabels:{enabled:!1},stroke:{width:2,curve:"smooth"},legend:{show:!1},markers:{size:6,colors:"transparent",strokeColors:"transparent",strokeWidth:4,discrete:[{fillColor:config.colors.white,seriesIndex:0,dataPointIndex:7,strokeColor:config.colors.primary,strokeWidth:2,size:6,radius:8}],hover:{size:7}},colors:[config.colors.primary],fill:{type:"gradient",gradient:{shade:r,shadeIntensity:.6,opacityFrom:.5,opacityTo:.25,stops:[0,95,100]}},grid:{borderColor:a,strokeDashArray:3,padding:{top:-20,bottom:-8,left:-10,right:8}},xaxis:{categories:["","Jan","Feb","Mar","Apr","May","Jun","Jul"],axisBorder:{show:!1},axisTicks:{show:!1},labels:{show:!0,style:{fontSize:"13px",colors:t}}},yaxis:{labels:{show:!1},min:10,max:50,tickAmount:4}};if(void 0!==typeof m&&null!==m){new ApexCharts(m,k).render()}const w=document.querySelector("#expensesOfWeek"),C={series:[65],chart:{width:50,height:50,type:"radialBar"},plotOptions:{radialBar:{startAngle:0,endAngle:360,strokeWidth:"8",hollow:{margin:2,size:"40%"},track:{strokeWidth:"50%",background:a},dataLabels:{show:!0,name:{show:!1},value:{formatter:function(o){return"$"+parseInt(o)},offsetY:5,color:"#697a8d",fontSize:"13px",show:!0}}}},fill:{type:"solid",colors:config.colors.primary},stroke:{lineCap:"round"},grid:{padding:{top:-10,bottom:-15,left:-10,right:-10}},states:{hover:{filter:{type:"none"}},active:{filter:{type:"none"}}}};if(void 0!==typeof w&&null!==w){new ApexCharts(w,C).render()}const S=document.querySelector("#performanceChart"),A={series:[{name:"Income",data:[26,29,31,40,29,24]},{name:"Earning",data:[30,26,24,26,24,40]}],chart:{height:270,type:"radar",toolbar:{show:!1},dropShadow:{enabled:!0,enabledOnSeries:void 0,top:6,left:0,blur:6,color:"#000",opacity:.14}},plotOptions:{radar:{polygons:{strokeColors:a,connectorColors:a}}},stroke:{show:!1,width:0},legend:{show:!0,fontSize:"13px",position:"bottom",labels:{colors:i,useSeriesColors:!1},markers:{height:10,width:10,offsetX:-3},itemMargin:{horizontal:10},onItemHover:{highlightDataSeries:!1}},colors:[config.colors.primary,config.colors.info],fill:{opacity:[1,.85]},markers:{size:0},grid:{show:!1,padding:{top:-8,bottom:-5}},xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun"],labels:{show:!0,style:{colors:[t,t,t,t,t,t],fontSize:"13px",fontFamily:"Public Sans"}}},yaxis:{show:!1,min:0,max:40,tickAmount:4}};if(void 0!==typeof S&&null!==S){new ApexCharts(S,A).render()}const v=document.querySelector("#totalBalanceChart"),z={series:[{data:[137,210,160,275,205,315]}],chart:{height:225,parentHeightOffset:0,parentWidthOffset:0,type:"line",dropShadow:{enabled:!0,top:10,left:5,blur:3,color:config.colors.warning,opacity:.15},toolbar:{show:!1}},dataLabels:{enabled:!1},stroke:{width:3,curve:"smooth"},legend:{show:!1},colors:[config.colors.warning],markers:{size:6,colors:"transparent",strokeColors:"transparent",strokeWidth:4,discrete:[{fillColor:config.colors.white,seriesIndex:0,dataPointIndex:5,strokeColor:config.colors.warning,strokeWidth:8,size:6,radius:8}],hover:{size:7}},grid:{show:!1,padding:{top:-10,left:0,right:0,bottom:10}},xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun"],axisBorder:{show:!1},axisTicks:{show:!1},labels:{show:!0,style:{fontSize:"13px",colors:t}}},yaxis:{labels:{show:!1}}};if(void 0!==typeof v&&null!==v){new ApexCharts(v,z).render()}const O=document.querySelector("#sessionOverviewChart"),W={series:[78],labels:["Loss Rate"],chart:{height:200,type:"radialBar"},colors:[config.colors.warning],plotOptions:{radialBar:{offsetY:0,startAngle:-140,endAngle:140,hollow:{size:"70%"},track:{strokeWidth:"40%",background:a},dataLabels:{name:{offsetY:60,color:i,fontSize:"13px",fontFamily:"Public Sans"},value:{offsetY:-10,color:e,fontSize:"26px",fontWeight:"500",fontFamily:"Public Sans"}}}},stroke:{lineCap:"round"},grid:{padding:{bottom:-20}},states:{hover:{filter:{type:"none"}},active:{filter:{type:"none"}}}};if(void 0!==typeof O&&null!==O){new ApexCharts(O,W).render()}const J=document.querySelector("#scoreChart"),M={series:[78],labels:["Out of 100"],chart:{height:195,type:"radialBar"},plotOptions:{radialBar:{size:150,offsetY:10,startAngle:-150,endAngle:150,hollow:{size:"55%"},track:{background:o,strokeWidth:"100%"},dataLabels:{name:{offsetY:15,color:i,fontSize:"13px",fontFamily:"Public Sans"},value:{offsetY:-20,color:e,fontSize:"22px",fontWeight:"500",fontFamily:"Public Sans"}}}},colors:[config.colors.primary],fill:{type:"gradient",gradient:{shade:"dark",shadeIntensity:.5,gradientToColors:[config.colors.primary],inverseColors:!0,opacityFrom:1,opacityTo:.6,stops:[30,70,100]}},stroke:{dashArray:5},grid:{padding:{top:-35,bottom:-10}},responsive:[{breakpoint:991,options:{chart:{height:"350px"}}}],states:{hover:{filter:{type:"none"}},active:{filter:{type:"none"}}}};if(void 0!==typeof J&&null!==J){new ApexCharts(J,M).render()}const R=document.querySelector("#totalRevenueChart"),F={series:[{name:"2021",data:[18,7,15,29,18,12,9]},{name:"2020",data:[-13,-18,-9,-14,-5,-17,-15]}],chart:{height:300,stacked:!0,type:"bar",toolbar:{show:!1}},plotOptions:{bar:{horizontal:!1,columnWidth:"30%",borderRadius:8,startingShape:"rounded",endingShape:"rounded"}},colors:[config.colors.primary,config.colors.info],dataLabels:{enabled:!1},stroke:{curve:"smooth",width:6,lineCap:"round",colors:[o]},legend:{show:!0,horizontalAlign:"left",position:"top",markers:{height:8,width:8,radius:12,offsetX:-3},labels:{colors:i},itemMargin:{horizontal:10}},grid:{borderColor:a,padding:{top:0,bottom:-8,left:20,right:20}},xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun","Jul"],labels:{style:{fontSize:"13px",colors:t}},axisTicks:{show:!1},axisBorder:{show:!1}},yaxis:{labels:{style:{fontSize:"13px",colors:t}}},responsive:[{breakpoint:1700,options:{plotOptions:{bar:{borderRadius:10,columnWidth:"35%"}}}},{breakpoint:1440,options:{plotOptions:{bar:{borderRadius:12,columnWidth:"43%"}}}},{breakpoint:1300,options:{plotOptions:{bar:{borderRadius:11,columnWidth:"45%"}}}},{breakpoint:1200,options:{plotOptions:{bar:{borderRadius:11,columnWidth:"37%"}}}},{breakpoint:1040,options:{plotOptions:{bar:{borderRadius:12,columnWidth:"45%"}}}},{breakpoint:991,options:{plotOptions:{bar:{borderRadius:12,columnWidth:"33%"}}}},{breakpoint:768,options:{plotOptions:{bar:{borderRadius:11,columnWidth:"28%"}}}},{breakpoint:640,options:{plotOptions:{bar:{borderRadius:11,columnWidth:"30%"}}}},{breakpoint:576,options:{plotOptions:{bar:{borderRadius:10,columnWidth:"38%"}}}},{breakpoint:440,options:{plotOptions:{bar:{borderRadius:10,columnWidth:"50%"}}}},{breakpoint:380,options:{plotOptions:{bar:{borderRadius:9,columnWidth:"60%"}}}}],states:{hover:{filter:{type:"none"}},active:{filter:{type:"none"}}}};if(void 0!==typeof R&&null!==R){new ApexCharts(R,F).render()}const B=document.querySelector("#growthChart"),I={series:[78],labels:["Growth"],chart:{height:240,type:"radialBar"},plotOptions:{radialBar:{size:150,offsetY:10,startAngle:-150,endAngle:150,hollow:{size:"55%"},track:{background:o,strokeWidth:"100%"},dataLabels:{name:{offsetY:15,color:i,fontSize:"15px",fontWeight:"600",fontFamily:"Public Sans"},value:{offsetY:-25,color:e,fontSize:"22px",fontWeight:"500",fontFamily:"Public Sans"}}}},colors:[config.colors.primary],fill:{type:"gradient",gradient:{shade:"dark",shadeIntensity:.5,gradientToColors:[config.colors.primary],inverseColors:!0,opacityFrom:1,opacityTo:.6,stops:[30,70,100]}},stroke:{dashArray:5},grid:{padding:{top:-35,bottom:-10}},states:{hover:{filter:{type:"none"}},active:{filter:{type:"none"}}}};if(void 0!==typeof B&&null!==B){new ApexCharts(B,I).render()}}();
