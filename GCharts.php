<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class GCharts {

    public function __construct()
    {
        log_message('debug', "GCharts Class Initialized");
    }

    private function wrapscript($type,$id,$data,$options)
    {
    	$t = 'corechart'
    	if($type=='gauge')
    	{
    		$t = 'gauge';
    	}
    	$d=json_encode($data);
    	$o=json_encode($options);

    	switch($type)
    	{
    		case 'gauge':
    			$method = 'Gauge';
    			break;
    		case 'column':
    			$method = "ColumnChart";
    			break;
    		case 'line':
    			$method = "LineChart";
    			break;
    		case 'area':
    			$method = "AreaChart";
    			break;
    		case 'pie':
    			$method = "PieChart";
    			break;
    	}

$w = <<<EOK
<script type='text/javascript'>
	google.load('visualization', '1', {packages:['{$t}']});
	google.setOnLoadCallback(draw{$id});
	function draw{$id}(){
		var data = google.visualization.arrayToDataTable({$d});
		var options = {$o};
		var chart = new google.visualization.{method}(document.getElementById('chart_{$id}'));
chart.draw(data, options);
	}
</script>
EOK;

	return $w;

    }

    public function gauge($id,$data=array(),$options=array())
    {

		//defaults
		$opt = array();
		$opt['animation'] = array();
		$opt['animation']['duration'] = 400;
		$opt['animation']['easing'] = 'linear'; //linear, in, out, inAndOut

		$opt['width'] = null;
		$opt['height'] = null;

		$opt['minorTicks'] = 5;
		$opt['majorTicks'] = null; // array("firstticktext","secondticktext",...)

		$opt['greenColor'] = '#109618'; // hex rgb or color name
		$opt['greenFrom'] = null;
		$opt['greenTo'] = null;

		$opt['yellowColor'] = '#FF9900'; // hex rgb or color name
		$opt['yellowFrom'] = null;
		$opt['yellowTo'] = null;

		$opt['redColor'] = '#DC3912'; // hex rgb or color name
		$opt['redFrom'] = null;
		$opt['redTo'] = null;

		$opt['min'] = 0; // min value of gauge
		$opt['max'] = 100; // max value of gauge

		$opt['redFrom'] = intval(0.9*$options['max']);
		$opt['redTo'] = $options['max'];
		$opt['yellowFrom'] = intval(0.75*$options['max']);
		$opt['yellowTo'] = $opt['redFrom'];

		//
		$options = array_merge($opt, $options);

		return $this->wrapscript('gauge',$id,$data,$options);

    }

    public function line($id,$data=array(),$options=array())
    {
    
		//defaults
		$opt = array();
		$opt['animation'] = array();
		$opt['animation']['duration'] = 400;
		$opt['animation']['easing'] = 'linear'; //linear, in, out, inAndOut

		$opt['width'] = null;
		$opt['height'] = null;

		$opt['axisTitlesPosition'] = 'in'; //in, out, none

		$opt['backgroundColor'] = array();
		$opt['backgroundColor']['stroke'] = '#666';
		$opt['backgroundColor']['strokeWidth'] = 0;
		$opt['backgroundColor']['fill'] = 'white';

		$opt['chartArea'] = array();
		$opt['chartArea']['left'] = 'auto';
		$opt['chartArea']['top'] = 'auto';
		$opt['chartArea']['width'] = 'auto';
		$opt['chartArea']['height'] = 'auto';

		$opt['colors'] = null; //array('#ff0090','red','grey','whitesmoke',...)

		$opt['curveType'] = 'none'; //none, function
		$opt['enableInteractivity'] = true;
		$opt['focusTarget'] = 'datum'; //datum, category
		$opt['fontSize'] = null;
		$opt['fontName'] = "Arial";

		$opt['hAxis'] = array();
		$opt['hAxis']['baseline'] = null;
		$opt['hAxis']['baselineColor'] = 'black';
		$opt['hAxis']['direction'] = 1; //1, -1
		$opt['hAxis']['format'] = null;
		$opt['hAxis']['gridlines'] = array();
		$opt['hAxis']['gridlines']['color'] = '#CCC';
		$opt['hAxis']['gridlines']['count'] = 5;
		$opt['hAxis']['minorGridlines'] = array();
		$opt['hAxis']['minorGridlines']['color'] = null;
		$opt['hAxis']['minorGridlines']['count'] = 0;
		$opt['hAxis']['logScale'] = false;
		$opt['hAxis']['textPosition'] = 'out';
		$opt['hAxis']['textStyle'] = array();
		$opt['hAxis']['textStyle']['color'] = 'black';
		$opt['hAxis']['textStyle']['fontName'] = null;
		$opt['hAxis']['textStyle']['fontSize'] = null;
		$opt['hAxis']['title'] = null;
		$opt['hAxis']['titleTextStyle'] = array();
		$opt['hAxis']['titleTextStyle']['color'] = 'black';
		$opt['hAxis']['titleTextStyle']['fontName'] = null;
		$opt['hAxis']['titleTextStyle']['fontSize'] = null;
		$opt['hAxis']['allowContainerBoundaryTextCutoff'] = false;
		$opt['hAxis']['slantedText'] = null;
		$opt['hAxis']['slantedTextAngle'] = 30;
		$opt['hAxis']['maxAlternation'] = 2;
		$opt['hAxis']['maxTextLines'] = 2;
		$opt['hAxis']['minTextSpacing'] = $opt['hAxis']['textStyle']['fontSize'];
		$opt['hAxis']['showTextEvery'] = 2;
		$opt['hAxis']['maxValue'] = null;
		$opt['hAxis']['minValue'] = null;
		$opt['hAxis']['viewWindowMode'] = 'pretty';
		$opt['hAxis']['viewWindow'] = array();
		$opt['hAxis']['viewWindow']['max'] = null;
		$opt['hAxis']['viewWindow']['min'] = null;

		$opt['isHtml'] = false;
		$opt['interpolateNulls'] =  false;

		$opt['legend'] = array();
		$opt['legend']['position'] = 'top';
		$opt['legend']['alignment'] = 'center';
		$opt['legend']['textStyle'] = array();
		$opt['legend']['textStyle']['color'] = 'black';
		$opt['legend']['textStyle']['fontName'] = null;
		$opt['legend']['textStyle']['fontSize'] = null;

		$opt['lineWidth'] = 2;
		$opt['pointSize'] = 3;
		$opt['reverseCategories'] = false;
		$opt['series'] = array();
		$opt['theme'] = null;
		$opt['title'] = null;
		$opt['titlePosition'] = 'none'; //in, out, none

		$opt['titleTextStyle'] = array();
		$opt['titleTextStyle']['color'] = 'black';
		$opt['titleTextStyle']['fontName'] = null;
		$opt['titleTextStyle']['fontSize'] = null;

		$opt['tooltip'] = array();
		$opt['tooltip']['showColorCode'] = null;
		$opt['tooltip']['textStyle'] = array();
		$opt['tooltip']['textStyle']['color'] = 'black';
		$opt['tooltip']['textStyle']['fontName'] = null;
		$opt['tooltip']['textStyle']['fontSize'] = null;
		$opt['tooltip']['trigger'] = 'focus'; //focus, none

		$opt['vAxes'] = null;
		$opt['vAxis'] = array();
		$opt['vAxis']['baseline'] = null;
		$opt['vAxis']['baselineColor'] = 'black';
		$opt['vAxis']['direction'] = 1;
		$opt['vAxis']['format'] = null;
		$opt['vAxis']['gridlines'] = array();
		$opt['vAxis']['gridlines']['color'] = '#CCC';
		$opt['vAxis']['gridlines']['count'] = 5;
		$opt['vAxis']['minorGridlines'] = array();
		$opt['vAxis']['minorGridlines']['color'] = null;
		$opt['vAxis']['minorGridlines']['count'] = 0;
		$opt['vAxis']['logScale'] = false;
		$opt['vAxis']['textPosition'] = 'out'; //out, in, none
		$opt['vAxis']['textStyle'] = array();
		$opt['vAxis']['textStyle']['color'] = 'black';
		$opt['vAxis']['textStyle']['fontName'] = null;
		$opt['vAxis']['textStyle']['fontSize'] = null;
		$opt['vAxis']['title'] = null;
		$opt['vAxis']['titleTextStyle'] = array();
		$opt['vAxis']['titleTextStyle']['color'] = 'black';
		$opt['vAxis']['titleTextStyle']['fontName'] = null;
		$opt['vAxis']['titleTextStyle']['fontSize'] = null;
		$opt['vAxis']['maxValue'] = null;
		$opt['vAxis']['minValue'] = null;
		$opt['vAxis']['viewWindowMode'] = 'pretty';
		$opt['vAxis']['viewWindow'] = array();
		$opt['vAxis']['viewWindow']['max'] = null;
		$opt['vAxis']['viewWindow']['min'] = null;

		$options = array_merge($opt, $options);

		return $this->wrapscript('line',$id,$data,$options);

    }

    public function area($id,$data=array(),$options=array())
    {
    	
		//defaults
		$opt = array();
		$opt['animation'] = array();
		$opt['animation']['duration'] = 400;
		$opt['animation']['easing'] = 'linear'; //linear, in, out, inAndOut

		$opt['areaOpacity'] = 0.3;

		$opt['width'] = null;
		$opt['height'] = null;

		$opt['axisTitlesPosition'] = 'in'; //in, out, none

		$opt['backgroundColor'] = array();
		$opt['backgroundColor']['stroke'] = '#666';
		$opt['backgroundColor']['strokeWidth'] = 0;
		$opt['backgroundColor']['fill'] = 'white';

		$opt['chartArea'] = array();
		$opt['chartArea']['left'] = 'auto';
		$opt['chartArea']['top'] = 'auto';
		$opt['chartArea']['width'] = 'auto';
		$opt['chartArea']['height'] = 'auto';

		$opt['colors'] = null; //array('#ff0090','red','grey','whitesmoke',...)

		$opt['curveType'] = 'none'; //none, function
		$opt['enableInteractivity'] = true;
		$opt['focusTarget'] = 'datum'; //datum, category
		$opt['fontSize'] = null;
		$opt['fontName'] = "Arial";

		$opt['hAxis'] = array();
		$opt['hAxis']['baseline'] = null;
		$opt['hAxis']['baselineColor'] = 'black';
		$opt['hAxis']['direction'] = 1; //1, -1
		$opt['hAxis']['format'] = null;
		$opt['hAxis']['gridlines'] = array();
		$opt['hAxis']['gridlines']['color'] = '#CCC';
		$opt['hAxis']['gridlines']['count'] = 5;
		$opt['hAxis']['minorGridlines'] = array();
		$opt['hAxis']['minorGridlines']['color'] = null;
		$opt['hAxis']['minorGridlines']['count'] = 0;
		$opt['hAxis']['logScale'] = false;
		$opt['hAxis']['textPosition'] = 'out';
		$opt['hAxis']['textStyle'] = array();
		$opt['hAxis']['textStyle']['color'] = 'black';
		$opt['hAxis']['textStyle']['fontName'] = null;
		$opt['hAxis']['textStyle']['fontSize'] = null;
		$opt['hAxis']['title'] = null;
		$opt['hAxis']['titleTextStyle'] = array();
		$opt['hAxis']['titleTextStyle']['color'] = 'black';
		$opt['hAxis']['titleTextStyle']['fontName'] = null;
		$opt['hAxis']['titleTextStyle']['fontSize'] = null;
		$opt['hAxis']['allowContainerBoundaryTextCutoff'] = false;
		$opt['hAxis']['slantedText'] = null;
		$opt['hAxis']['slantedTextAngle'] = 30;
		$opt['hAxis']['maxAlternation'] = 2;
		$opt['hAxis']['maxTextLines'] = 2;
		$opt['hAxis']['minTextSpacing'] = $opt['hAxis']['textStyle']['fontSize'];
		$opt['hAxis']['showTextEvery'] = 2;
		$opt['hAxis']['maxValue'] = null;
		$opt['hAxis']['minValue'] = null;
		$opt['hAxis']['viewWindowMode'] = 'pretty';
		$opt['hAxis']['viewWindow'] = array();
		$opt['hAxis']['viewWindow']['max'] = null;
		$opt['hAxis']['viewWindow']['min'] = null;

		$opt['isHtml'] = false;
		$opt['interpolateNulls'] =  false;

		$opt['legend'] = array();
		$opt['legend']['position'] = 'top';
		$opt['legend']['alignment'] = 'center';
		$opt['legend']['textStyle'] = array();
		$opt['legend']['textStyle']['color'] = 'black';
		$opt['legend']['textStyle']['fontName'] = null;
		$opt['legend']['textStyle']['fontSize'] = null;

		$opt['lineWidth'] = 2;
		$opt['pointSize'] = 3;
		$opt['reverseCategories'] = false;
		$opt['series'] = array();
		$opt['theme'] = null;
		$opt['title'] = null;
		$opt['titlePosition'] = 'none'; //in, out, none

		$opt['titleTextStyle'] = array();
		$opt['titleTextStyle']['color'] = 'black';
		$opt['titleTextStyle']['fontName'] = null;
		$opt['titleTextStyle']['fontSize'] = null;

		$opt['tooltip'] = array();
		$opt['tooltip']['showColorCode'] = null;
		$opt['tooltip']['textStyle'] = array();
		$opt['tooltip']['textStyle']['color'] = 'black';
		$opt['tooltip']['textStyle']['fontName'] = null;
		$opt['tooltip']['textStyle']['fontSize'] = null;
		$opt['tooltip']['trigger'] = 'focus'; //focus, none

		$opt['vAxes'] = null;
		$opt['vAxis'] = array();
		$opt['vAxis']['baseline'] = null;
		$opt['vAxis']['baselineColor'] = 'black';
		$opt['vAxis']['direction'] = 1;
		$opt['vAxis']['format'] = null;
		$opt['vAxis']['gridlines'] = array();
		$opt['vAxis']['gridlines']['color'] = '#CCC';
		$opt['vAxis']['gridlines']['count'] = 5;
		$opt['vAxis']['minorGridlines'] = array();
		$opt['vAxis']['minorGridlines']['color'] = null;
		$opt['vAxis']['minorGridlines']['count'] = 0;
		$opt['vAxis']['logScale'] = false;
		$opt['vAxis']['textPosition'] = 'out'; //out, in, none
		$opt['vAxis']['textStyle'] = array();
		$opt['vAxis']['textStyle']['color'] = 'black';
		$opt['vAxis']['textStyle']['fontName'] = null;
		$opt['vAxis']['textStyle']['fontSize'] = null;
		$opt['vAxis']['title'] = null;
		$opt['vAxis']['titleTextStyle'] = array();
		$opt['vAxis']['titleTextStyle']['color'] = 'black';
		$opt['vAxis']['titleTextStyle']['fontName'] = null;
		$opt['vAxis']['titleTextStyle']['fontSize'] = null;
		$opt['vAxis']['maxValue'] = null;
		$opt['vAxis']['minValue'] = null;
		$opt['vAxis']['viewWindowMode'] = 'pretty';
		$opt['vAxis']['viewWindow'] = array();
		$opt['vAxis']['viewWindow']['max'] = null;
		$opt['vAxis']['viewWindow']['min'] = null;

		$options = array_merge($opt, $options);

		return $this->wrapscript('area',$id,$data,$options);

    }

    public function pie($id,$data=array(),$options=array())
    {

		//defaults
		$opt = array();
		$opt['animation'] = array();
		$opt['animation']['duration'] = 400;
		$opt['animation']['easing'] = 'linear'; //linear, in, out, inAndOut

		$opt['width'] = null;
		$opt['height'] = null;

		$opt['backgroundColor'] = array();
		$opt['backgroundColor']['stroke'] = '#666';
		$opt['backgroundColor']['strokeWidth'] = 0;
		$opt['backgroundColor']['fill'] = 'white';

		$opt['chartArea'] = array();
		$opt['chartArea']['left'] = 'auto';
		$opt['chartArea']['top'] = 'auto';
		$opt['chartArea']['width'] = 'auto';
		$opt['chartArea']['height'] = 'auto';

		$opt['colors'] = null; //array('#ff0090','red','grey','whitesmoke',...)

		$opt['fontSize'] = null;
		$opt['fontName'] = "Arial";

		$opt['is3D'] = false;

		$opt['legend'] = array();
		$opt['legend']['position'] = 'top';
		$opt['legend']['alignment'] = 'center';
		$opt['legend']['textStyle'] = array();
		$opt['legend']['textStyle']['color'] = 'black';
		$opt['legend']['textStyle']['fontName'] = null;
		$opt['legend']['textStyle']['fontSize'] = null;

		$opt['slices'] = array();

		$opt['pieSliceBorderColor'] = 'white';
		$opt['pieSliceText'] = 'percentage'; //percentage, value, label, none
		$opt['pieSliceTextStyle'] = array();
		$opt['pieSliceTextStyle']['color'] = 'black';
		$opt['pieSliceTextStyle']['fontName'] = null;
		$opt['pieSliceTextStyle']['fontSize'] = null;

		$opt['reverseCategories'] = false;

		$opt['sliceVisibilityThreshold'] = 1/720; // don't show slices smaller than half a degree (combine them on a bigger one sum of their sizes)
		$opt['pieResidueSliceColor'] = '#CCC';
		$opt['pieResidueSliceLabel'] = '...';

		$opt['title'] = null;

		$opt['titleTextStyle'] = array();
		$opt['titleTextStyle']['color'] = 'black';
		$opt['titleTextStyle']['fontName'] = null;
		$opt['titleTextStyle']['fontSize'] = null;

		$opt['tooltip'] = array();
		$opt['tooltip']['showColorCode'] = null;
		$opt['tooltip']['textStyle'] = array();
		$opt['tooltip']['textStyle']['color'] = 'black';
		$opt['tooltip']['textStyle']['fontName'] = null;
		$opt['tooltip']['textStyle']['fontSize'] = null;
		$opt['tooltip']['trigger'] = 'focus'; //focus, none

		$options = array_merge($opt, $options);

		return $this->wrapscript('pie',$id,$data,$options);
    	
    }

    public function column($id,$data=array(),$options=array())
    {
    	
		//defaults
		$opt = array();
		$opt['animation'] = array();
		$opt['animation']['duration'] = 400;
		$opt['animation']['easing'] = 'linear'; //linear, in, out, inAndOut

		$opt['width'] = null;
		$opt['height'] = null;

		$opt['backgroundColor'] = array();
		$opt['backgroundColor']['stroke'] = '#666';
		$opt['backgroundColor']['strokeWidth'] = 0;
		$opt['backgroundColor']['fill'] = 'white';

		$opt['bar'] = array();
		$opt['bar']['groupWidth'] = '61.8%'; //golden ratio approximation

		$opt['chartArea'] = array();
		$opt['chartArea']['left'] = 'auto';
		$opt['chartArea']['top'] = 'auto';
		$opt['chartArea']['width'] = 'auto';
		$opt['chartArea']['height'] = 'auto';

		$opt['colors'] = null; //array('#ff0090','red','grey','whitesmoke',...)

		$opt['enableInteractivity'] = true;
		$opt['focusTarget'] = 'datum'; //datum, category
		$opt['fontSize'] = null;
		$opt['fontName'] = "Arial";

		$opt['hAxis'] = array();
		$opt['hAxis']['baseline'] = null;
		$opt['hAxis']['baselineColor'] = 'black';
		$opt['hAxis']['direction'] = 1; //1, -1
		$opt['hAxis']['format'] = null;
		$opt['hAxis']['gridlines'] = array();
		$opt['hAxis']['gridlines']['color'] = '#CCC';
		$opt['hAxis']['gridlines']['count'] = 5;
		$opt['hAxis']['minorGridlines'] = array();
		$opt['hAxis']['minorGridlines']['color'] = null;
		$opt['hAxis']['minorGridlines']['count'] = 0;
		$opt['hAxis']['logScale'] = false;
		$opt['hAxis']['textPosition'] = 'out';
		$opt['hAxis']['textStyle'] = array();
		$opt['hAxis']['textStyle']['color'] = 'black';
		$opt['hAxis']['textStyle']['fontName'] = null;
		$opt['hAxis']['textStyle']['fontSize'] = null;
		$opt['hAxis']['title'] = null;
		$opt['hAxis']['titleTextStyle'] = array();
		$opt['hAxis']['titleTextStyle']['color'] = 'black';
		$opt['hAxis']['titleTextStyle']['fontName'] = null;
		$opt['hAxis']['titleTextStyle']['fontSize'] = null;
		$opt['hAxis']['allowContainerBoundaryTextCutoff'] = false;
		$opt['hAxis']['slantedText'] = null;
		$opt['hAxis']['slantedTextAngle'] = 30;
		$opt['hAxis']['maxAlternation'] = 2;
		$opt['hAxis']['maxTextLines'] = 2;
		$opt['hAxis']['minTextSpacing'] = $opt['hAxis']['textStyle']['fontSize'];
		$opt['hAxis']['showTextEvery'] = 2;
		$opt['hAxis']['maxValue'] = null;
		$opt['hAxis']['minValue'] = null;
		$opt['hAxis']['viewWindowMode'] = 'pretty';
		$opt['hAxis']['viewWindow'] = array();
		$opt['hAxis']['viewWindow']['max'] = null;
		$opt['hAxis']['viewWindow']['min'] = null;

		$opt['isHtml'] = false;
		$opt['isStacked'] = false;

		$opt['legend'] = array();
		$opt['legend']['position'] = 'top';
		$opt['legend']['alignment'] = 'center';
		$opt['legend']['textStyle'] = array();
		$opt['legend']['textStyle']['color'] = 'black';
		$opt['legend']['textStyle']['fontName'] = null;
		$opt['legend']['textStyle']['fontSize'] = null;

		$opt['series'] = array();
		$opt['theme'] = null;
		$opt['title'] = null;
		$opt['titlePosition'] = 'none'; //in, out, none

		$opt['titleTextStyle'] = array();
		$opt['titleTextStyle']['color'] = 'black';
		$opt['titleTextStyle']['fontName'] = null;
		$opt['titleTextStyle']['fontSize'] = null;

		$opt['tooltip'] = array();
		$opt['tooltip']['showColorCode'] = null;
		$opt['tooltip']['textStyle'] = array();
		$opt['tooltip']['textStyle']['color'] = 'black';
		$opt['tooltip']['textStyle']['fontName'] = null;
		$opt['tooltip']['textStyle']['fontSize'] = null;
		$opt['tooltip']['trigger'] = 'focus'; //focus, none

		$opt['vAxes'] = null;
		$opt['vAxis'] = array();
		$opt['vAxis']['baseline'] = null;
		$opt['vAxis']['baselineColor'] = 'black';
		$opt['vAxis']['direction'] = 1;
		$opt['vAxis']['format'] = null;
		$opt['vAxis']['gridlines'] = array();
		$opt['vAxis']['gridlines']['color'] = '#CCC';
		$opt['vAxis']['gridlines']['count'] = 5;
		$opt['vAxis']['minorGridlines'] = array();
		$opt['vAxis']['minorGridlines']['color'] = null;
		$opt['vAxis']['minorGridlines']['count'] = 0;
		$opt['vAxis']['logScale'] = false;
		$opt['vAxis']['textPosition'] = 'out'; //out, in, none
		$opt['vAxis']['textStyle'] = array();
		$opt['vAxis']['textStyle']['color'] = 'black';
		$opt['vAxis']['textStyle']['fontName'] = null;
		$opt['vAxis']['textStyle']['fontSize'] = null;
		$opt['vAxis']['title'] = null;
		$opt['vAxis']['titleTextStyle'] = array();
		$opt['vAxis']['titleTextStyle']['color'] = 'black';
		$opt['vAxis']['titleTextStyle']['fontName'] = null;
		$opt['vAxis']['titleTextStyle']['fontSize'] = null;
		$opt['vAxis']['maxValue'] = null;
		$opt['vAxis']['minValue'] = null;
		$opt['vAxis']['viewWindowMode'] = 'pretty';
		$opt['vAxis']['viewWindow'] = array();
		$opt['vAxis']['viewWindow']['max'] = null;
		$opt['vAxis']['viewWindow']['min'] = null;

		$options = array_merge($opt, $options);

		return $this->wrapscript('column',$id,$data,$options);

    }

}

/* End of file GCharts.php */
