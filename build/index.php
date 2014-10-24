<?php

require ('auth/session.php');
require ('auth/user.php');

$user = new User();
if ($user->isLoggedIn()){
	if (!empty($_POST['logout']) && ($_POST['logout'] === 'Log out')) {
		$user->logout();
	}
}else {
	if (!empty($_POST['login']) && ($_POST['login'] === 'Log in')) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		if ($user->authenticate($username, $password)) {
			$_SESSION['user_name'] = $username;
		}
		else {
			$errorMessage = "Try again";
		}	
	} else {
		$errorMessage = NULL;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<!-- head starts -->
	<head>
		<script type="text/javascript" src="js/widgets/d3/accordionWidget.js"></script>
		<script type="text/javascript" src="js/widgets/d3/newResultsWidget.js"></script>
		<script type="text/javascript" src="js/widgets/d3/openLayers.js"></script>
		<script type="text/javascript" src="js/widgets/d3/openStreetMap.js"></script>
		<script type="text/javascript" src="js/widgets/d3/openlayersMap.js"></script>
		<script type="text/javascript" src="js/widgets/d3/stockWidget.js"></script>
		<script type="text/javascript" src="js/widgets/d3/widgetBarras.js"></script>
		<script type="text/javascript" src="js/widgets/d3/widgetD3.js"></script>
		<script type="text/javascript" src="js/widgets/d3/widgetDonuts.js"></script>
		<script type="text/javascript" src="js/widgets/d3/widgetMap.js"></script>
		<script type="text/javascript" src="js/widgets/d3/widgetSortBar.js"></script>
		<script type="text/javascript" src="js/widgets/d3/widgetWheel.js"></script>
		<script type="text/javascript">
			var widgetX = [accordionWidget, newResultsWidget, openLayers, openStreetMap, openlayersMap, stockWidget, widgetBarras, widgetD3, widgetDonuts, widgetMap, widgetSortBar, widgetWheel];
		</script>
		<meta charset="utf-8" />
		<title>SEFARAD</title>
		<!-- global stylesheets -->
		<link rel="stylesheet" href="css/main.css" type="text/css"/>
		<link rel="stylesheet" href="css/wizard.css" type="text/css"/>
		<link rel="stylesheet" href="css/widgets.css" type="text/css"/>
		<link rel="stylesheet" href="css/themes/redmond/jquery-ui-1.9.2.custom.css" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="js/ext/jquery.autocomplete.css" media="screen" />
		<!-- kendo widgets stylesheets -->
		<link rel="stylesheet" href="css/ext/kendo.default.min.css" type="text/css"/>
		<link rel="stylesheet" href="css/ext/kendo.common.min.css" type="text/css"/>
		<link rel="stylesheet" href="css/ext/kendo.dataviz.min.css" type="text/css"/>
		<!-- ui help guide stylesheet -->
		<link rel=" stylesheet" type="text/css" href="css/ext/joyride-2.0.2.css"/>
		<!-- bot stylesheets -->
		<link rel="stylesheet" href="css/global.css" type="text/css">
    	<link rel="stylesheet" href="css/animate-custom.css" type="text/css">
    	<!-- qtip stylesheets -->
    	<link rel="stylesheet" href="css/ext/jquery.qtip.css" type="text/css">
    
    	<!-- datatable stylesheets -->
    	<!--<link rel="stylesheet" href="css/ext/datatablesPlugin.css" type="text/css"> -->    	
    	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.css" type="text/css">
    	<!-- Import OL CSS, auto import does not work with our minified OL.js build -->
        <link rel="stylesheet" type="text/css" href="http://demos.gsi.dit.upm.es/geoserver/openlayers/theme/default/style.css">
		<!-- javascript -->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript" charset="UTF-8" src="js/ext/underscore.js"></script>
		<!-- jquery related -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
		<script src="js/ext/jquery.tmpl.js"></script>
		<script src="js/ext/jquery.ui.touch-punch.min.js"></script>
		<script type="text/javascript" charset="UTF-8" src="js/ext/jquery.blockUI.js"></script>
		<script type="text/javascript" charset="UTF-8" src="js/ext/jquery.autocomplete.js"></script>
		<!-- kendo & knockout -->
		<script src="js/ext/kendo.all.min.js"></script>
		<script src="js/ext/knockout-2.1.0.js"></script>
		<script src="js/ext/knockout-kendo.min.js"></script>
		<script type="text/javascript" src="js/ext/knockout.mapping.js"></script>
		<!-- sefarad -->
		<script type="text/javascript" charset="UTF-8" src="js/charts_configuration.js"></script>
		<script type="text/javascript" charset="UTF-8" src="js/lang.js"></script>
		<script type="text/javascript" charset="UTF-8" src="js/default_configuration.js"></script>
		<script type="text/javascript" charset="UTF-8" src="js/ext/wizards.js"></script>
		<!-- graphics -->
		<script type="text/javascript" charset="UTF-8" src="js/ext/highcharts.js"></script>
		<script type="text/javascript" charset="UTF-8" src="js/ext/grid.js"></script>
		<script type="text/javascript" src="js/highchart.js"></script>
		<!-- ajax solr-->
		<script type="text/javascript" charset="UTF-8" src="ajax-solr/core/Core.js"></script>
		<script type="text/javascript" charset="UTF-8" src="ajax-solr/core/AbstractManager.js"></script>
		<script type="text/javascript" charset="UTF-8" src="ajax-solr/managers/Manager.jquery.js"></script>
		<script type="text/javascript" charset="UTF-8" src="ajax-solr/helpers/ajaxsolr.theme.js"></script>
		<script type="text/javascript" charset="UTF-8" src="ajax-solr/core/Parameter.js"></script>
		<script type="text/javascript" charset="UTF-8" src="ajax-solr/core/ParameterStore.js"></script>
		<script type="text/javascript" charset="UTF-8" src="ajax-solr/core/AbstractWidget.js"></script>
		<script type="text/javascript" charset="UTF-8" src="ajax-solr/core/AbstractTextWidget.js"></script>
		<script type="text/javascript" charset="UTF-8" src="ajax-solr/core/AbstractFacetWidget.js"></script>
		<script type="text/javascript" charset="UTF-8" src="ajax-solr/core/AbstractParamWidget.js"></script>
		<!-- widgets -->
		<script type="text/javascript" charset="UTF-8" src="js/widgets/ext/AutocompleteWidget.js"></script>
		<script type="text/javascript" charset="UTF-8" src="js/widgets/ext/PagerWidget.js"></script>
		<script type="text/javascript" charset="UTF-8" src="js/widgets/ext/ResultWidget.2.0.js"></script>
		<!-- other -->
		<script type="text/javascript" charset="UTF-8" src="js/ext/sammy-latest.min.js"></script>
		<script src="js/ext/jquery.isotope.min.js"></script>
		<script src="js/ext/jquery.joyride-2.0.2.js"></script>
    	<script src="js/ext/jquery.scrollTo.js"></script>
		<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
		<script src="js/datatablesPlugin.js" charset="utf-8"></script>
		<!-- external -->
		<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
		<script type='text/javascript' src="js/ext/twitterApi.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
		<script type="text/javascript" src="js/ext/sparql-geojson.js"></script>
		
		<!-- openlayers -->
		<script src="http://openlayers.org/api/OpenLayers.js"></script>
        <!-- <script type="text/javascript" charset="UTF-8" src="js/ext/OpenLayers.js"></script> -->
		<!-- qtip -->
		<script type="text/javascript" src="js/ext/jquery.qtip.js"></script>
		<script type="text/javascript" src="js/ext/imagesloaded.pkg.min.js"></script>
		<!-- json -->
		<script type="text/javascript" charset="UTF-8" src="json_examples/countries.js"></script>
		<script type="text/javascript" charset="UTF-8" src="json_examples/netherlands.js"></script>
		<script type="text/javascript" charset="UTF-8" src="json_examples/poligonosUsa.js"></script>

		<script type="text/javascript" charset="UTF-8">
			$(document).ready(function () {
				$(".button").button();
				vm.routes();
				if (errorinroute || sparqlmode) {
					console.log("Aplicamos bindings");
					ko.applyBindings(vm);
				}

				vm.adminMode(<?php echo($user->isLoggedIn()) ?>);

				$(".sparqlquery").click(function () {
					sparqlPanel()
				});
				$("#backgroundPopup").click(function () {
					sparqlPanel()
				});
				$("#max_icon").click(function () {
					if(vm.botMax()){
						vm.botMax(false);
					}else{
						vm.botMax(true);
					}
				});
				$('#qtip-help').live('mouseover', function(event) {
					$(this).qtip({

						content: $(this).attr('help-text'),
						position: {
					        my: 'top right',  
					        at: 'bottom left', 
					        target: $(this) 
					    },
						overwrite: true,
						show: {
						  event: event.type,
						  ready: true
						}
						   
					}, event);
				});

				$('#qtip-help-conf').live('mouseover', function(event) {
					$(this).qtip({

						content: $(this).attr('help-text'),
						position: {
					        my: 'left',  
					        at: 'right', 
					        target: $(this) 
					    },
						overwrite: true,
						show: {
						  event: event.type,
						  ready: true
						}
						   
					}, event);
				});

				$("#accordion").live('load', function(){
				    $(this).accordion({
				      heightStyle: "content",
				    });
				});

				//initIsotopeAndWizards();
			});

			$(window).load(function () {
				$('#dvLoading').hide();
			});
			
		</script>

	</head>
	<!-- ends head -->
	<!-- body starts -->
	<body><section id='qtip-help-conf' help-text='ruta de la imagen logo de la página'></section>
		<!-- Loading animation -->
		<div id="dvLoading"></div>
		<div class="allcontent" data-bind="visible: page() == 0">
			<header class="topbar">
				<!-- Sparql query form -->
				<!-- Only visible in SPARQL mode -->			
				<div id="sparqlQueryContainer" data-bind="visible: sparql()">
					<div id="sparqlQueryPanel">
						<textarea data-bind="value: sparqlQuery">Enter your SPARQL query here</textarea>
					</div>
					<div class="sparqlquery" data-bind="visible: showSparqlPanel(), click: $root.getResultsSPARQL()">
						<h2>Ejecutar consulta</h2>
					</div>
				</div>
				<div id="backgroundPopup"></div>
				<!-- Top bar logos & title -->
				<div id="logos" data-bind="visible: !showSparqlPanel()">
					<!-- ko if: logoPath == undefined -->
					<!-- /ko -->
					<div id="logotext"><img src="img/smod2.png"><span data-bind="text: pageTitle"></span></div>
				</div>
				<!-- Search and help area -->
				<div class="right_area" >

					<div id="login-box" style="float:right; width:30%; height:100%">
						<div class="inner">							
							<ul>
								<?php if(!isset($_SESSION['user_id'])): ?>
									<form id="login" action="" method="post" accept-charset="utf-8">
										<?php if(isset($errorMessage)): ?>
										<li><?php echo $errorMessage; ?></li>
										<?php endif ?>
										<li>										
											<input class="textbox" style="float:right" tabindex="1" type="text" name="username" placeholder="User" autocomplete="off"/>
										</li>
										<li>
											<input class="textbox" style="float:right"  tabindex="2" type="password" name="password" placeholder="Password"/>
										</li>
										<li>
											<input id="login-submit" name="login" tabindex="3" type="submit" value="Log in" style="float:right"/>
										</li>
										<li class="clear"></li>
									</form>
								<?php endif ?>
								<?php if(isset($_SESSION['user_id'])): ?>
									<form id="logout" action="" method="post" accept-charset="utf-8">
										<li style="float:right; font-size:18px;"><?php echo ('Welcome ' . $_SESSION['user_name'] . '!') ?></li>
										<li class="clear"></li>
										</br></br></br>
										<li>
											<input id="logout-submit" name="logout" tabindex="3" type="submit" value="Log out" style="float:right"/>
										</li>
									</form>
								<?php endif ?>									
							</ul>							
						</div>
					</div>
					
					<div class="icon"><img src="img/help.png" alt="Help" data-bind="click: $root.showHelp"/></div>
					<div id ="configuration-button" class ="icon" data-bind="click: $root.showConfiguration, visible: $root.adminMode"><img src="img/settings.png" alt="Configuration" /></div>

					<div class="search" id="search-container">
						<div class="search-inner">
							<div id="search-btn"></div>
							<!-- es el form el que da estilo al input -->
							<!-- ko if: $root.sparql -->
							<input style="background-color:#000;border:none;color:#fff;font-size:.95em;height:24px;;padding:0 0 0 
								0px;position:relative;width:178px;" id="query" size="80" 
								data-bind="attr: { placeholder: lang().searchplaceholder }, kendoAutoComplete: { data: autoCompleteFields, value: filter, animation: false }"/>
							<!-- /ko -->
							<!-- ko ifnot: $root.sparql -->
							<input style="background-color:#000;border:none;color:#fff;font-size:.95em;height:24px;;padding:0 0 0 
								0px;position:relative;width:178px;" id="query" size="80"  
								data-bind="attr: { placeholder: lang().searchplaceholder }, kendoAutoComplete: { data: autoCompleteFieldsSOLR, value: filter, animation: false }"/>
							<!-- /ko -->
						</div>
					</div>	 

				</div>
				<!-- Configuration section (hidden by default) -->
				<div id="configuration" data-bind="fadeVisible: showConfigurationPanel">
					<div class="ui-widget-header">
						<h2 data-bind="text: lang().configuration"></h2>
					</div>
					<div class="col1">
						<h3 data-bind="text: lang().personalization"></h3>
						<ul>
							<li>
								<center><table>
									<tr>
										<th>
											<span data-bind="text: lang().pagetitle"></span>	
										</th>
										<th>
											<span id='qtip-help-conf' data-bind="attr: {'help-text': lang().pagetitlehelp}" class="ui-icon ui-icon-help" ></span>
										</th>	
									</tr>								
								</table></center>
							
							</li>
							<li>
								<input id="pagetitle" type="text" data-bind="value: pageTitle" placeholder="Título de la página" />
							</li>							

							<li>
								<center><table>
									<tr>
										<th>
											<span data-bind="text: lang().logo"></span>	
										</th>
										<th>
											<span id='qtip-help-conf' data-bind="attr: {'help-text': lang().logohelp}" class="ui-icon ui-icon-help" ></span>
										</th>	
									</tr>								
								</table></center>
							
							</li>
							<li><input id="logopath" type="text" data-bind="value: logoPath" placeholder="Logo de la página" /></li>			

							<li>
								<center><table>
									<tr>
										<th>
											<div data-bind="text: lang().language"></div>	
										</th>
										<th>
											<span id='qtip-help-conf' data-bind="attr: {'help-text': lang().languagehelp}" class="ui-icon ui-icon-help" ></span>
										</th>	
									</tr>								
								</table></center>							
							</li>							
							<li><select id="lang" data-bind="options: languages, value: selectedLanguage, optionsCaption: 
								lang().langcaption"></select></li>
							
							<li>
								<center><table>
									<tr>
										<th>
											<input type="checkbox" style="width:13px;" data-bind="checked: activedAutocomplete"/>
										</th>
										<th>
											<span data-bind="text: lang().autocomplete"></span>	
										</th>
										<th>
											<span id='qtip-help-conf' data-bind="attr: {'help-text': lang().autocompletehelp}" class="ui-icon ui-icon-help" ></span>
										</th>	
									</tr>								
								</table></center>							
							</li>										
							<li><select data-bind="options: dataColumns, value: autocomplete_fieldname, optionsCaption: lang().fieldcaption, enable: activedAutocomplete"></select></li>
							<li><input type="checkbox" style="width:13px;" data-bind="checked: sortableWidgets"/><label data-bind="text: lang().sortableWidgets"></label></li>
							<li><input type="checkbox" style="width:13px;" data-bind="checked: accordionLayout"/><label data-bind="text: 'AccordioLayout'"></label></li>	
						</ul>
					</div>
					<div class="col2">
						<div data-bind="visible: !sparql()">
							<h3 data-bind="text: lang().globalvar"></h3>
							<p data-bind="text: lang().lmfroute"></p>
							<p data-bind="text: serverURL"></p>
						</div>
						<div data-bind="visible: sparql()">
							<center><table>
									<tr>
										<th>
											<h3 data-bind="text: lang().sparqlaccessendpoint"></h3>	
										</th>
										<th>
											<div id='qtip-help-conf' class="ui-icon ui-icon-help" data-bind="attr: {'help-text': lang().sparqlhelp}"></div>
										</th>	
									</tr>								
								</table></center>							
							<input id="serverURL" type="text" data-bind="value: sparql_baseURL" placeholder="SPARQL endpoint"/>
						</div>
						<div data-bind="visible: !sparql()">
							<h3 data-bind="text: lang().advancedoptions"></h3>
							<button class="button" data-bind="click: $root.reindexSOLR, visible: !sparql()"><span data-bind="text: 
								lang().reindexsolr"></span></button>							
						</div>

						<div id='tabs-config'>
							<h3 data-bind="text: lang().tabs"></h3>
							<center>
							<div id='checkboxes'>							
								<input type="checkbox" style="width:13px;" data-bind="checked: searchTabEnabled"/><label data-bind="text: lang().search"></label>							
								<input type="checkbox" style="width:13px;" data-bind="checked: dashboardTabEnabled"/><label data-bind="text: lang().dashboard"></label>							
								<input type="checkbox" style="width:13px;" data-bind="checked: payolaTabEnabled"/><label data-bind="text: lang().payola"></label>							
								<input type="checkbox" style="width:13px;" data-bind="checked: sparqlEditorTabEnabled"/><label data-bind="text: lang().sparqleditor"></label>							
							</div>
							</center>
						</div>

						<p></p>

						<div data-bind="visible: sparql()">
							<center><table>
									<tr>
										<th>
											<h3 data-bind="text: lang().sparqlquery"></h3>	
										</th>
										<th>
											<div id='qtip-help-conf' class="ui-icon ui-icon-help" data-bind="attr: {'help-text': lang().sparqlqueryhelp}"></div>
										</th>	
									</tr>								
								</table>								
							<div  id="search-container" align="center">
								<div >									
									<!-- es el form el que da estilo al input -->
									<!-- ko if: $root.sparql -->
									<input style="background-color:#fff;border:none;color:#000;font-size:.95em;height:24px;;padding:0 0 0 
										0px;position:relative;width:300px;" id="query" size="80" 
										data-bind="attr: { placeholder: lang().searchplaceholder }, kendoAutoComplete: { data: autoCompleteFields, value: filter, animation: false }"/>
									<!-- /ko -->
									<!-- ko ifnot: $root.sparql -->
									<input style="background-color:#fff;border:none;color:#000;font-size:.95em;height:24px;;padding:0 0 0 
										0px;position:relative;width:300px;" id="query" size="80"  
										data-bind="attr: { placeholder: lang().searchplaceholder }, kendoAutoComplete: { data: autoCompleteFieldsSOLR, value: filter, animation: false }"/>
									<!-- /ko -->
									<button type="button" data-bind="text: lang().runquery" style="display: inline-block;"></button>
								</div>
							</div>	
							</center>
						</div>
					</div>
					<div style="clear:both">					
						<button class="button" id="save_changes" ><span data-bind="text: lang().savechanges, click: $root.doSave" ></span> </button>
						<button class="button" data-bind="click: $root.resetConfiguration"><span data-bind="text: lang().resetconf"></span></button>
					</div>
					<br/>
				</div>
			</header>
			<!-- new widget wizard -->
			<div data-bind="kendoWindow: { isOpen: openNewWidgetManager, title: lang().addWidget, visible: false }">
				<div class="widgetWizard">
					<div id="cssmenu">
						<ul id="filters" class="option-set">
							<li><a href="" data-filter="*" class="selected"><label data-bind="text:lang().showAll"></label></a></li>
							<li><a href="" data-filter=".cat5"><label data-bind="text:lang().results"></a></li>
							<li><a href="" data-filter=".cat1"><label data-bind="text:lang().textFilter"></a></li>
							<li><a href="" data-filter=".cat2"><label data-bind="text:lang().numericFilter"></a></li>
							<li><a href="" data-filter=".cat3"><label data-bind="text:lang().graph"></a></li>
							<li><a href="" data-filter=".cat6"><label data-bind="text:lang().map"></a></li>
							<li><a href="" data-filter=".cat4"><label data-bind="text:lang().other"></a></li>
						</ul>
					</div>
					<div id="wizard-content">
						<div class="box cat5">
							<h1 data-bind="text: lang().resultsvertical"></h1>
							<table id="wrapper">
								<tr>
									<td><img src="img/results_vertical.png" alt="Results Vertical"/></td>
								</tr>
							</table>
							<div class="mask">
								<h2 data-bind="text: lang().resultsvertical"></h2>
								<p data-bind="text: lang().resultsverticalexp"></p>
								<button class="button" data-bind="click: $root.addResultsVerticalWidget"><span data-bind="text: 
									lang().addWidget2"></span></button>
							</div>
						</div>
						<div class="box cat5">
							<h1 data-bind="text: lang().resultsgrid"></h1>
							<table id="wrapper">
								<tr>
									<td><img src="img/results_grid.png" alt="Results Grid"/></td>
								</tr>
							</table>
							<div class="mask">
								<h2 data-bind="text: lang().resultsgrid"></h2>
								<p data-bind="text: lang().resultsgridexp"></p>
								<button class="button" data-bind="click: $root.addResultsGridWidget"><span data-bind="text: 
									lang().addWidget2"></span></button>
							</div>
						</div>						
						<div class="box cat2">
							<h1 data-bind="text: lang().numericwidget"></h1>
							<table id="wrapper">
								<tr>
									<td><img src="img/slider_widget.png" alt="Slider"/></td>
								</tr>
							</table>
							<div class="mask">
								<h2 data-bind="text: lang().numericwidget"></h2>
								<p data-bind="text: lang().numericwidgetexp"></p>
								<select data-bind="options: $root.dataColumns, value: newNumericFilterValue, optionsCaption: 
									lang().fieldcaption"></select>
								<button class="button" data-bind="click: $root.addSliderWidget, enable: newNumericFilterValidation"><span 
									data-bind="text: lang().addWidget2"></span></button>
							</div>
						</div>
						<div class="box cat3 cat4">
							<h1 data-bind="text: lang().gauge"></h1>
							<table id="wrapper">
								<tr>
									<td><img src="img/gauge_widget.png" alt="Slider"/></td>
								</tr>
							</table>
							<div class="mask">
								<h2 data-bind="text: lang().gauge"></h2>
								<p data-bind="text: lang().gaugeexp"></p>
								<button class="button" data-bind="click: $root.addGaugeWidget"><span data-bind="text: 
									lang().addWidget2"></span></button>
							</div>
						</div>
						<div class="box cat3">
							<h1 data-bind="text: lang().resultstats"></h1>
							<table id="wrapper">
								<tr>
									<td><img src="img/resultstats_widget.png" alt="Result Stats"/></td>
								</tr>
							</table>
							<div class="mask">
								<h2 data-bind="text: lang().resultstats"></h2>
								<p data-bind="text: lang().resultstatsexp"></p>
								<button class="button" data-bind="click: $root.addResultStatsWidget, enable: !showResultsGraphsWidget()"><span 
									data-bind="text: lang().addWidget2, visible: !showResultsGraphsWidget()"></span><span data-bind="text: 
									lang().alreadyAdded, visible: showResultsGraphsWidget()"></span></button>
							</div>
						</div>
						<div class="box cat1">
							<h1 data-bind="text: lang().tagcloud"></h1>
							<table id="wrapper">
								<tr>
									<td><img src="img/tagcloud_widget.png" alt="Tagcloud"/></td>
								</tr>
							</table>
							<div class="mask">
								<h2 data-bind="text: lang().tagcloud"></h2>
								<p data-bind="text: lang().tagcloudexp"></p>
								<select data-bind="options: $root.dataColumns, value: newTagCloudValue, optionsCaption: lang().fieldcaption"></select>
								<button class="button" data-bind="click: $root.addTagCloudWidget, enable: newTagCloudValue()!=undefined">
									<span data-bind="text: lang().addWidget2"></span>
								</button>
							</div>
						</div>
						<div class="box cat1">
							<h1 data-bind="text: lang().panelbar"></h1>
							<table id="wrapper">
								<tr>
									<td><img src="img/panelbar_widget.png" alt="Panelbar"/></td>
								</tr>
							</table>
							<div class="mask">
								<h2 data-bind="text: lang().panelbar"></h2>
								<p data-bind="text: lang().panelbarexp"></p>
								<select data-bind="options: $root.dataColumns, value: newPanelBarValue, optionsCaption: 
									lang().fieldcaption"></select>
								<button class="button" data-bind="click: $root.addPanelBarWidget, enable: newPanelBarValue()!=undefined"><span 
									data-bind="text: lang().addWidget2"></span></button>						
							</div>
						</div>
						<div class="box cat4">
							<h1 data-bind="text: lang().twitter"></h1>
							<table id="wrapper">
								<tr>
									<td><img src="img/twitter_widget.png" alt="Panelbar"/></td>
								</tr>
							</table>
							<div class="mask">
								<h2 data-bind="text: lang().twitter"></h2>
								<p data-bind="text: lang().twitterexp"></p>
								<select data-bind="options: $root.dataColumns, value: newTwitterValue, optionsCaption: 
									lang().fieldcaption"></select>
								<button class="button" data-bind="click: $root.addTwitterWidget, enable: newTwitterValue()!=undefined"><span 
									data-bind="text: lang().addWidget2"></span></button>						
							</div>
						</div>
						<div class="box cat3">
							<h1 data-bind="text: lang().piechart"></h1>
							<table id="wrapper">
								<tr>
									<td><img src="img/piechart_widget.png" alt="Piechart"/></td>
								</tr>
							</table>
							<div class="mask">
								<h2 data-bind="text: lang().piechart"></h2>
								<p data-bind="text: lang().piechartexp"></p>
								<select data-bind="options: $root.dataColumns, value: newPieChartValue, optionsCaption: 
									lang().fieldcaption"></select>
								<button class="button" data-bind="click: $root.addPieChartWidget, enable: newPieChartValue()!=undefined"><span 
									data-bind="text: lang().addWidget2"></span></button>						
							</div>
						</div>
						<div class="box cat3">
							<h1 data-bind="text: lang().barchart"></h1>
							<table id="wrapper">
								<tr>
									<td><img src="img/barchart_widget.png" alt="Panelbar"/></td>
								</tr>
							</table>
							<div class="mask">
								<h2 data-bind="text: lang().barchart"></h2>
								<p data-bind="text: lang().barchartexp"></p>
								<select data-bind="options: $root.dataColumns, value: newBarChartValue, optionsCaption: 
									lang().fieldcaption"></select>
								<button class="button" data-bind="click: $root.addBarChartWidget, enable: newBarChartValue()!=undefined"><span 
									data-bind="text: lang().addWidget2"></span></button>						
							</div>
						</div>
						<div data-bind="template: { name: 'new-widgets-template', foreach: newWidgets }"></div>
					</div>
				</div>
			<!-- wizard end -->
			</div>
			<!-- sgvizler widgets wizard -->
			<div data-bind="kendoWindow: { isOpen: openSgvizlerManager, title: lang().addWidget, visible: false }">
				<div id="wizard-global">
					<div id="sgvizlermanager_1">
						<div id="cssmenu">
							<ul>
								<h2>Selecciona el tipo de gráfico estático</h2>
							</ul>
						</div>
						<div id="wizard-content">
							<div class="sgvizler_table">
								<table class="sgvizlertable">
									<tbody id="sgvizlertable">
										<tr>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/sMap.png.thumb.jpg"><br>sgvizler.visualization.Map</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gGeoMap.png.thumb.jpg"><br>google.visualization.GeoMap</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gGeoChart.png.thumb.jpg"><br>google.visualization.GeoChart</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/dForceGraph.png.thumb.jpg"><br>sgvizler.visualization.D3ForceGraph</td>
										</tr>
										<tr>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gLineChart.png.thumb.jpg"><br>google.visualization.LineChart</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gAreaChart.png.thumb.jpg"><br>google.visualization
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gSteppedAreaChart.png.thumb.jpg"><br>google.visualization.SteppedAreaChart</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gBarChart.png.thumb.jpg"><br>google.visualization.BarChart</td>
										</tr>
										<tr>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gPieChart.png.thumb.jpg"><br>google.visualization.PieChart</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gOrgChart.png.thumb.jpg"><br>google.visualization.OrgChart</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gTreeMap.png.thumb.jpg"><br>google.visualization.TreeMap</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gSparkline.png.thumb.jpg"><br>google.visualization.Sparkline</td>
										</tr>
										<tr>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gMotionChart.png.thumb.jpg"><br>google.visualization.MotionChart</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gScatterChart.png.thumb.jpg"><br>google.visualization.ScatterChart</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gBubbleChart.png.thumb.jpg"><br>google.visualization.BubbleChart</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gTimeline.png.thumb.jpg"><br>google.visualization.Timeline</td>
										</tr>
										<tr>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gGauge.png.thumb.jpg"><br>google.visualization.Gauge</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/gTable.png.thumb.jpg"><br>google.visualization.Table</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/sDefList.png.thumb.jpg"><br>sgvizler.visualization.DefList</td>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/sList.png.thumb.jpg"><br>sgvizler.visualization.List</td>
										</tr>
										<tr>
											<td style="border: 1px solid #ccc; padding: 5px;"><img 
												src="http://sgvizler.googlecode.com/svn/www/screenshots/thumb/sText.png.thumb.jpg"><br>sgvizler.visualization.Text</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div id="sgvizlermanager_2" style="display: none">
						<div id="cssmenu">
							<ul>
								<img id="back2" src="img/back.png">
								<h2 data-bind="text: sgvizlerGraphType"></h2>
							</ul>
						</div>
						<div id="wizard-content">
							<div class="sgvizler-form">
								<textarea data-bind="value: sgvizlerQuery">Enter your SPARQL query here</textarea>
								<br>
								<button class="button" data-bind="click: $root.addSgvizlerWidget"><span data-bind="text: 
									lang().addWidget2"></span></button>
							</div>
						</div>
					</div>
				</div>
			<!-- sgvizler wizard end -->
			</div>
			<!-- below top bar -->
			<div class="page-header" style="padding-top: 0px;"></div>
			<ul class="tabrow">				
				<li data-bind="css: {'selected': activeTab() == 0}, click: function() { $root.activeTab(0); }, visible: searchTabEnabled"><a data-bind="text: lang().search"></a></li>
				<li data-bind="css: {'selected': activeTab() == 1}, click: function() { $root.activeTab(1); }, visible: dashboardTabEnabled"><a data-bind="text: lang().dashboard"></a></li>
				<li data-bind="css: {'selected': activeTab() == 2}, click: function() { $root.activeTab(2); }, visible: payolaTabEnabled"><a data-bind="text: lang().payola"></a></li>
				<li data-bind="css: {'selected': activeTab() == 3}, click: function() { $root.activeTab(3); }, visible: sparqlEditorTabEnabled"><a data-bind="text: lang().sparqleditor"></a></li>
			</ul>
			<!-- Starts main content -->
			<div class="maincontent" data-bind="visible: page() == 0">
				<!--<button data-bind="click: $root.test">Cambiar pestaña</button>-->
				<!-- Notification when saving configuration -->
				<div class="growlUI" style="display:none"></div>
				<!-- Layout in two columns -->
				<div id="columns" data-bind="visible: activeTab() == 0">
					<!-- column 0 tab 0 start -->
					<div id="column0tab0" class="column">
						<!-- Add new widget section (left column) -->
						<div class="addNewWidget" data-bind="visible: $root.adminMode">
							<h1 data-bind="click: $root.openNewWidgetManagerMethod, text: lang().addWidget"></h1>
						</div>
						<!-- all widgets at left column -->
						<!-- more effects: http://jqueryui.com/effect/#easing -->
						<!-- linear layout -->
						<div data-bind="visible: !($root.accordionLayout())">							
							<div class="container" data-bind="template: { name: 'widgets-template', foreach: activeWidgetsLeft, 
								beforeRemove: function(elem) { $(elem).slideUp(1500,'easeOutBounce', function() {$(elem).remove(); });  }, 
								templateOptions: { parentList: activeWidgetsLeft} }, sortableList: activeWidgetsLeft"></div>
						</div>
						<!-- accordion layout -->
						<div data-bind="visible: $root.accordionLayout, foreach: activeWidgetsLeft, accordion: {}">
						    <h3><a href="#" data-bind="text: title"></a></h3>
						    <div data-bind="template: { name: 'widgets-template-accordion', foreach: $data}"></div>
						</div>						
						<!-- column 0 tab 0 end -->
					</div>
					<!-- column 1 tab 0 start -->
					<div id="column1tab0" class="column" >
						<!-- Widgets at right column -->
						<div class="container right" data-bind="template: { name: 'widgets-template', foreach: activeWidgetsRight, 
							beforeRemove: function(elem) { $(elem).slideUp(1500,'easeOutBounce', function() {$(elem).remove(); });  }, 
							templateOptions: { parentList: activeWidgetsRight} }, sortableList: activeWidgetsRight"></div>
						<!-- column 1 tab 0 end -->
					</div>
					<!-- end two columns -->
				</div>
				<!-- columns in tab 1 -->
				<div id="columns" data-bind="visible: activeTab() == 1">
					<div id="column0tab1" class="column">
						<!-- Add new widget section (left column) -->
						<div class="addNewWidget" data-bind="visible: $root.adminMode">
							<h1 data-bind="click: $root.openSgvizlerManagerMethod, text: lang().addSgvizlerWidget"></h1>
						</div>
						<!-- all widgets -->
						<!-- more effects: http://jqueryui.com/effect/#easing -->
						<div class="container" data-bind="template: { name: 'widgets-template', foreach: activeWidgetsLeftTab1, 
							beforeRemove: function(elem) { $(elem).slideUp(1500,'easeOutBounce', function() {$(elem).remove(); });  }, 
							templateOptions: { parentList: activeWidgetsLeftTab1} }, sortableList: activeWidgetsLeftTab1"></div>
					</div>
					<div id="column1tab1" class="column">
						<div class="container right" data-bind="template: { name: 'widgets-template', foreach: activeWidgetsRightTab1, 
							beforeRemove: function(elem) { $(elem).slideUp(1500,'easeOutBounce', function() {$(elem).remove(); });  }, 
							templateOptions: { parentList: activeWidgetsRightTab1} }, sortableList: activeWidgetsRightTab1"></div>
					</div>
					<!-- end two columns (tab 1) -->
				</div>

				<!-- columns in tab 3 -->
				<div id="columns" data-bind="visible: activeTab() == 3">
					<center><iframe src="http://demos.gsi.dit.upm.es/tomcat/sparqled/" width="800" height="600" align="center"></iframe></center> 
				</div>

				<!-- ends maincontent -->
			</div>
			<div class="pre-footer">
				<br/>
			</div>
			<!-- footer (only visible in main page) -->
			<div class="footer" data-bind="visible: page() == 0" style="text-align: center">
				<hr>
				</br>
				<div style="display:inline">
					<!--<img src="img/logo2.png" style="float: right;"/>-->
					<a href="http://gsi.dit.upm.es/" target="_blank">
						<img height="100px" src="img/logo_gsi.png" alt="GSI-UPM"/>
						<!--
							<div class="gsiLogo" title="Grupo de Sistemas Inteligentes" ></div>
							-->
					</a>
					<img src="img/logoAvanza.png" alt="Plan Avanza 2">
					<a href="http://www.paradigmatecnologico.com/">
					<img src="img/paradigma.jpg" alt="Paradigma Tecnológico">
					</a>
				</div>
			</div>

			<!-- bot_chat_window -->
			<!-- <div class="visible" id="bot_chat_window" >
	          <div id="upper_bar">
	          	<button id="max_icon" ></button>
	            <h3>
	              <img id="bot_avatar" src="img/bot/avatars/duke_waiting.png" />
		          <span style="clear: both;"></span>
	            </h3>
	          </div>
	          <div id="screen_wrapper" data-bind="visible: botMax() == true">
	            <div id="msg_dialog"></div>
	            <div id="screen"></div>
	            <div id="meta_msgs"></div>
	            <div id="userbar">   
	                <form id="userinput" method="get" action="http://demos.gsi.dit.upm.es/gsibot/bottle/TalkToBot" > 
	                  <input type="hidden" name="userAgent" value="web_html_v1" />
	                  <input type="hidden" name="bot" value="Duke" />
	                  <input type="hidden" name="type" value="json" />
			  		  <input type="hidden" name="user" value="a"/>
	                  <input type="text" name="q" />
	                  <input type="submit" name="submit" value="Enviar" />
	                </form>
	            </div>
	          </div>
	        </div> -->
		<!-- ends allcontent -->
		</div>

		<!-- different error pages -->
		<div data-bind="visible: page() == 1">
			<div class="mini_inner centered">
				<img src="img/alert.png" alt class="alert">
				<h1 data-bind="text: lang().errorroute"></h1>
				<p data-bind="text: lang().errorroute1"></p>
				<div class="center">
					<a href="index.html#/main/nombredelcore">index.html#/main/nombredelcore</a>
					<a href="index.html#/sparql">index.html#/sparql</a>
				</div>
			</div>
			<div class="bottom">
				<!--<a href="" class="mini_logo">Sefarad</a>-->
			</div>
		</div>
		<div data-bind="visible: page() == 2">
			<div class="mini_inner centered">
				<img src="img/alert.png" alt class="alert">
				<h1 data-bind="text: lang().errorcore"></h1>
				<p data-bind="text: lang().errorcore1"></p>
				<div class="center">
					<select data-bind="options: listCores, value: core, optionsCaption: lang().corecaption, visible: listCores().length > 0"></select>
					<button data-bind="click: $root.start, visible: listCores().length > 0"><span data-bind="text: lang().accept"></span></button>
				</div>
			</div>
			<div class="bottom">
			</div>
		</div>
		<div class="initialConfiguration" data-bind="visible: page() == 3">
			<div class="mini_inner centered">
				<img src="img/alert.png" alt class="alert">
				<h1 data-bind="text: lang().errorcore2"></h1>
				<div class="center">
					<select data-bind="options: listCores, value: core, optionsCaption: lang().corecaption, visible: listCores().length > 0"></select>
					<button data-bind="click: $root.start, visible: listCores().length > 0"><span data-bind="text: lang().accept"></span></button>
				</div>
			</div>
		</div>
		<div class="initialConfiguration" data-bind="visible: page() == 4">
			<div class="mini_inner centered">
				<img src="img/alert.png" alt class="alert">
				<h1 data-bind="text: lang().errorserverurl"></h1>
				<p data-bind="text: lang().errorserverurl1"></p>
			</div>
		</div>
		<!--
			<div class="initialConfiguration" data-bind="visible: page() == 5">
				<div id="mini_inner" class="centered">
					<img src="img/alert.png" alt class="alert">
					<h1>Debe identificarse</h1>
					<input type="text" data-bind="value: username" placeholder="Nombre de usuario" />
					<input type="password" data-bind="value: password" placeholder="Contraseña" />
					<button data-bind="click: $root.doLogin">Aceptar</button>
				</div>
			</div>
			-->
			<!-- Help section -->
			<ol id="TipContent">
				<li data-id="logotext" data-text="Next">
					<h2 data-bind="text: lang().tutoh1"></h2>
					<p data-bind="text: lang().tuto1"></p>
				</li>
				<li data-id="configuration-button" data-button="Next">
					<h2 data-bind="text: lang().tutoh2"></h2>
					<p data-bind="text: lang().tuto2"></p>
				</li>
				<li data-class="resultswidget-header" data-button="Next">
					<h2 data-bind="text: lang().tutoh3"></h2>
					<p data-bind="text: lang().tuto3"></p>
				</li>
				<li data-class="addNewWidget" data-button="Next">
					<h2 data-bind="text: lang().tutoh4"></h2>
					<p data-bind="text: lang().tuto4"></p>
				</li>
				<li data-id="query" data-button="Next" data-options="tipLocation:top;">
					<h2 data-bind="text: lang().tutoh5"></h2>
					<p data-bind="text: lang().tuto5"></p>
				</li>
				<li data-id="save_changes" data-button="Next">
					<h2 data-bind="text: lang().tutoh6"></h2>
					<p data-bind="text: lang().tuto6"></p>
				</li>
				<li data-class="gsiLogo" data-options="tipLocation:top;" data-button="Close" >
					<h2 data-bind="text: lang().tutoh7"></h2>
					<p data-bind="text: lang().tuto7"></p>
				</li>
			</ol>
			
		<!-- Different templates -->
<script type="text/javascript" charset="UTF-8" src="js/lang.js"></script>
		<script id="widgets-template" type="text/html">
			<div class="item" data-bind="sortableItem: { item: $data, parentList: $item.parentList }">
			<!-- Widgets with own configuration first -->
			
			<!-- Results Widget -->
			{{if type()=="resultswidget"}}
			<div class="ui-widget">
				<div class="ui-widget-header">
					<div style="float:left">
						<div class="ui-icon" data-bind="css: 
							{'ui-icon-arrow-1-s': collapsed(), 'ui-icon-arrow-1-n': !collapsed()}, click: $root.collapseWidget"></div>
					</div>
					<h3><a href="#" data-bind="text: title, click: function() { $root.editTitle($data); }, visible: $data !== 
						$root.editingTitle()"></a></h3>
					<input data-bind="value: title, visibleAndSelect: $data === $root.editingTitle(), event: { 
						blur: function() { $root.editTitle(''); } }"/>
					<div style="display:inline-block; float: right;">
						<div style="float: right;" 
							class="ui-icon ui-icon-trash" data-bind="click: $root.deleteWidget.bind($data, id(), type()), visible: 
							$root.adminMode"></div>
						<div class="ui-icon ui-icon-gear" style="float: right;" data-bind="visible: $root.adminMode, click: 
							function(){showWidgetConfiguration(!showWidgetConfiguration());}"></div>
						<div id='qtip-help' class="ui-icon ui-icon-help" style="float:right" data-bind="attr: {'help-text': $root.lang().resultsWidgetHelp }"></div>
					</div>
				</div>
				<div class="ui-widget-content" data-bind="visible: !collapsed()">
				<div class="widget-configuration" data-bind="fadeVisible: showWidgetConfiguration">
					<div data-bind="template: { name: 'results-layout', foreach: $root.resultsLayout }"></div>
				</div>
				<div class="resultswidget-header">
					<div>
						<select id="pager-perPage" data-bind="value: $root.num_shown">
						    <option value=10>10</option>
	      					<option value=20>20</option>
	        				<option value=30>30</option>
	        				<option value=40>40</option>
	      					<option value=50>50</option>
	      					<option data-bind="value: $root.filteredData().length">All</option>  					
						</select>
						<label alt="Per page" data-bind="text:$root.lang().perPage"></label>

						{{if $root.sparql()}}
						<div id="pager-header">
							<span data-bind="text: $root.resultsSparqlText" alt=""></span>
						</div>
						<div>
							<ul id="pager">
								<a href="#" data-bind="click: $root.showLessSPARQL ">← Prev</a>
								<a href="#" data-bind="click: $root.showMoreSPARQL ">Next →</a>
							</ul>
						</div>

						{{else}}
						<div id="pager-header"></div>
						<ul id="pager"></ul>

						{{/if}}
					</div>
					<br>
					<h2 data-bind="visible: $root.anyActiveFilter(), text: $root.lang().activefilters"></h2>
					<h2 data-bind="visible: !$root.anyActiveFilter(), text: $root.lang().notActiveFilters"></h2>
					<div data-bind="template: { name: 'list-active-filter', foreach: $root.activeWidgets } " ></div>
					<a href="#" class="tag" data-bind="text: $root.filter, click: function() { $root.filter(''); }, visible: $root.filter()!=''"></a>
					<br>
				</div>
				
				{{if $root.sparql()}}

					<div id="alertmsg" class="alertmsg-yellow" data-bind="visible: $root.filteredData().length == 0"><span data-bind="text: $root.lang().nodata"></span></div>
					<div id="resultados">
						<div class="resultado" data-bind="visible: $root.filteredData().length > 0, template: { name: 
						'results-sparql', foreach: $root.shownSparqlData, afterRender: $root.animateResultsChange }">
						</div>
					</div>									
					
				{{else}}
				
					<div id="alertmsg" class="alertmsg-yellow" data-bind="visible: $root.filteredData().length == 0"><span data-bind="text: $root.lang().nodata"></span></div>	
				
					{{if layout()=="grid"}}
						<ul id="contenedorr" data-bind="template: { name: 'cards', foreach: $root.filteredData, afterAdd: 
						$root.serviceAdded }, jqIsotope: $root.isotope">
						</ul>
					{{/if}}
						
					{{if layout()=="vertical"}}
							<div class="resultados" data-bind="visible: $root.filteredData().length > 0, template: { name: 
						'simple', foreach: $root.shownData, afterRender: $root.animateResultsChange }">
							</div>
					{{/if}}	
				{{/if}}		
			<!--se cierra widget-content-->
			</div>
			
			</div>
			
			<!-- Results stats widget -->
			{{else type()=="resultstats"}}
			
			<li class="ui-widget">
				<div class="ui-widget-header">
					<div style="float:left">
						<div class="ui-icon" data-bind="css: 
							{'ui-icon-arrow-1-s': collapsed(), 'ui-icon-arrow-1-n': !collapsed()}, click: $root.collapseWidget"></div>
					</div>
					<h3><a href="#" 
						data-bind="text: title, click: function() { $root.editTitle($data); }, visible: $data !== $root.editingTitle()"></a></h3>
					<input 
						data-bind="value: title, visibleAndSelect: $data === $root.editingTitle(), event: { blur: function() { $root.editTitle(''); } }"/>
					<div style="display:inline-block; float: right;">
						<div style="float: right;" class="ui-icon ui-icon-trash" data-bind="click: 
							$root.deleteWidget.bind($data, id(), type()), visible: $root.adminMode"></div>
						<div class="ui-icon ui-icon-gear" id="resultsConfig" style="float: 
							right;" data-bind="visible: $root.adminMode, click: 
							function(){showWidgetConfiguration(!showWidgetConfiguration());}"></div>
						<div id='qtip-help' class="ui-icon ui-icon-help" style="float:right" data-bind="attr: {'help-text': $root.lang().resultStatsHelp }"></div>
					</div>
				</div>
				<div class="ui-widget-content" 
					data-bind="visible: !collapsed()">
					<div class="widget-configuration" data-bind="fadeVisible: showWidgetConfiguration">
						<div data-bind="template: { name: 'widget-template-resultsstats', foreach: $root.resultsGraphs }" style="display: 
							inline"></div>
					</div>
					<div class="graphics"></div>
				</div>
			</li>
			
			<!-- Tagcloud widget -->
			{{else type()=="tagcloud"}}
			<li class="ui-widget">
			<div class="ui-widget-header">
				<div style="float:left">
					<div class="ui-icon" data-bind="css: 
						{'ui-icon-arrow-1-s': collapsed(), 'ui-icon-arrow-1-n': !collapsed()}, click: $root.collapseWidget"></div>
				</div>
				<h3><a 
					href="#" data-bind="text: title, click: function() { $root.editTitle($data); }, visible: $data !== 
					$root.editingTitle()"></a></h3>
				<input data-bind="value: title, visibleAndSelect: $data === $root.editingTitle(), event: { 
					blur: function() { $root.editTitle(''); } }"/>
				<div style="display:inline-block; float: right;">
					<div style="float: right;" 
						class="ui-icon ui-icon-trash" data-bind="click: $root.deleteWidget.bind($data, id(), type()), visible: 
						$root.adminMode"></div>
					<div class="ui-icon ui-icon-gear" style="float: right;" data-bind="visible: $root.adminMode, click: 
						function(){showWidgetConfiguration(!showWidgetConfiguration());}"></div>
					<div id='qtip-help' class="ui-icon ui-icon-help" style="float:right" data-bind="attr: {'help-text': $root.lang().tagCloudHelp }"></div>
				</div>
			</div>
			<div class="ui-widget-content" 
				data-bind="visible: !collapsed()">
			
			{{if layout()=="vertical"}}
				<div class="widget-configuration" data-bind="fadeVisible: showWidgetConfiguration">
					<p>Estilo del Widget</p>
					<img height="32px" width="32px" src="img/tag_icon.png" data-bind="click: $root.switchLayout"/>
					<img height="32px" width="32px" class="activo" src="img/list_icon.png"/>
				</div>
				<ul data-bind="kendoPanelBar: { }">
					<li>
						<span class="filterName" data-bind="text: title()"></span>	
						<ul data-bind="template: {name: 'widget-template-panelbar', foreach: $data.values }"></ul>
					</li>
				</ul>
			{{else}}
				<div class="widget-configuration" data-bind="fadeVisible: showWidgetConfiguration">
					<p>Estilo del Widget</p>
					<img height="32px" width="32px" class="activo" src="img/tag_icon.png"/>
					<img height="32px" width="32px" src="img/list_icon.png" data-bind="click: $root.switchLayout"/>
				</div>	
				
				<div class="tagarea"><div data-bind="template: { name: 'widget-template-tagcloud', templateOptions: {parent_id: id 
					},foreach: values }"></div></div>			
			{{/if}}

			<!-- Accordion widget -->
			{{else type()=="accordion"}}
			<li class="ui-widget">
			<div class="ui-widget-header">
				<div style="float:left">
					<div class="ui-icon" data-bind="css: {'ui-icon-arrow-1-s': collapsed(), 'ui-icon-arrow-1-n': !collapsed()}, click: $root.collapseWidget"></div>
				</div>
				<h3><a href="#" data-bind="text: title, click: function() { $root.editTitle($data); }, visible: $data !== $root.editingTitle()"></a></h3>
				<input data-bind="value: title, visibleAndSelect: $data === $root.editingTitle(), event: { blur: function() { $root.editTitle(''); } }"/>
				<div style="display:inline-block; float: right;">
					<div style="float: right;" class="ui-icon ui-icon-trash" data-bind="click: $root.deleteWidget.bind($data, id(), type()), visible: 
						$root.adminMode"></div>
					<div class="ui-icon ui-icon-gear" style="float: right;" data-bind="visible: $root.adminMode, click: 
						function(){showWidgetConfiguration(!showWidgetConfiguration());}"></div>
					<div id='qtip-help' class="ui-icon ui-icon-help" style="float:right" data-bind="attr: {'help-text': $root.lang().tagCloudHelp }"></div>
				</div>
			</div>
			<div class="ui-widget-content" data-bind="visible: !collapsed()">			
				<div class="widget-configuration" data-bind="fadeVisible: showWidgetConfiguration">
					<p>Seleccione un nuevo campo</p>					
				</div>
				<div class="tagarea">
					<div data-bind="template: { name: 'widget-template-tagcloud', templateOptions: {parent_id: id },foreach: values }"></div>
				</div>
			</div>
			
			<!-- Other widget -->
			{{else}}
				<li class="ui-widget">
					<div class="ui-widget-header">
						<div style="float:left">
							<div class="ui-icon" data-bind="css: 
								{'ui-icon-arrow-1-s': collapsed(), 'ui-icon-arrow-1-n': !collapsed()}, click: $root.collapseWidget">
							</div>
						</div>
						<h3><a 
							href="#" data-bind="text: title, click: function() { $root.editTitle($data); }, visible: $data !== 
							$root.editingTitle()"></a></h3>
						<input data-bind="value: title, visibleAndSelect: $data === $root.editingTitle(), event: { 
							blur: function() { $root.editTitle(''); } }"/>
						<div class="ui-icon ui-icon-trash" style="float:right" data-bind="click: 
								$root.deleteWidget.bind($data, id(), type()), visible: $root.adminMode"></div>
						<div id='qtip-help' class="ui-icon ui-icon-help" style="float:right" data-bind="attr: {'help-text': $root.lang().otherWidgetHelp }"></div>
						<div class="ui-icon ui-icon-gear" style="float: right;" data-bind="visible: $root.adminMode, click: 
							function(){showWidgetConfiguration(!showWidgetConfiguration());}"></div>
					</div>

					<div class="ui-widget-content" data-bind="visible: !collapsed()">

						<!-- Slider widget -->
						{{if type()=="slider"}}
						<div class="slider"></br><span>Rango filtrado: </span><span data-bind="text: values"></span><div data-bind="slider: $data, 
							sliderOptions: {min: $data.limits()[0], max: $data.limits()[1], values: $data.values(), step: $data.value()}"></div></br></div>
						
						<!-- Radial gauge widget -->
						{{else type()=="radialgauge"}}
						<div id="gauge-container"><div id="gauge" data-bind="kendoRadialGauge: {value: $root.numberOfResults, scale: { max: 
							$root.getMaxNumberOfResults(), labels: { visible: true }, majorUnit: $root.getGaugeMajorUnits() } } "></div><div 
							id="contador"><p data-bind="text: $root.numberOfResults"></p></div></div>	
						
						<!-- Twitter widget -->
						{{else type()=="twitter"}}
						
						{{if currentTweets().length > 0 }}
						<table width='100%' data-bind="template: { name: 'widget-template-twitter', foreach: currentTweets }"></table>
						
						{{else}}
						<p>No se han podido obtener resultados</p>
						{{/if}}
						
						<!-- Rest widget -->
						{{else type()=="piechart"}}
						<div data-bind="attr: {'id': id }"></div>
						{{else type()=="barchart"}}
						<div data-bind="attr: {'id': id }"></div>
						{{else type()=="barchartD3"}}
						<div data-bind="attr: {'id': id }"></div>
						{{else type()=="sgvizler"}}
						<div data-bind="attr: { 'id': id }"></div>
						{{else}}
						<div class="widget-configuration" data-bind="attr: { 'id': configid }, fadeVisible: showWidgetConfiguration"></div>
						<div data-bind="attr: { 'id': id }"></div>
						{{/if}}
					</div>
				</li>
			
			{{/if}}
			</div>			
		</script>
		<script id="widgets-template-accordion" type="text/html">
			<div >
				{{if type()=="radialgauge"}}
					<div id="gauge-container">
						<div id="gauge" data-bind="kendoRadialGauge: {value: $root.numberOfResults, scale: { max: 
							$root.getMaxNumberOfResults(), labels: { visible: true }, majorUnit: $root.getGaugeMajorUnits() } } "></div>
						<div id="contador">
							<p data-bind="text: $root.numberOfResults"></p>
						</div>
					</div>
				{{/if}}
			</div>			
		</script>	
		<script id="widget-template-tagcloud" type="text/html">
			<a href='#' class="tag" data-bind="click: $root.tagCloudSelection.bind($data, $parent.id(), id, name()), css: { selected: state()}">
				<span data-bind="text: name"></span>
				<span class="count" data-bind="css: {'zero': count()=='0' }, text: count"></span>
			</a>
		</script>	
		<script id="widget-template-panelbar" type="text/html">
			<li class="k-item k-state-default">
			    <a class="filter k-link" href="#" data-bind="text: $root.getTagcloudItem(name(), count()),
			    click: $root.tagCloudSelection.bind($data, $parent.id(), id, name()),
			    css: { 'panelselected': state() == true}"></a>
			</li>	
		</script>		
		<script id="widget-template-resultsstats" type="text/html">
			<input type="checkbox" data-bind="checked: state" />
			<label data-bind="text: type"></label>	
		</script>		
		<script id="widget-template-twitter" type="text/html">
			<tr><td><img data-bind='attr: { src: profile_image_url }' /></td><td><a class='twitterUser' data-bind='attr: { href: 
			"http://twitter.com/" + from_user }, text: from_user' href='http://twitter.com/${ from_user }' > </a><p data-bind="text: text"> 
			</p><div class='tweetInfo' data-bind='text: created_at'> </div></td></tr>
		</script>
		<script id="list-active-filter" type="text/html">
			{{if type()=="tagcloud"}} 
				<span data-bind="template: { name: 'active-filter', foreach: values, afterRender: $root.animateTagsChange } " > 
				</span>
			{{/if}}
		</script>
		<script id="active-filter" type="text/html">
			<div data-bind="visible: state()" style="display: inline;">
				<div style="display: inline;">
					<a href="#" class="tag" data-bind="text: name, click: $root.tagCloudSelection.bind($data, $parent.id(), id, name())"></a>
				</div>
			</div>
		</script>
		<script id="results-layout" type="text/html">
			<p data-bind="text: Name"></p>
			<input data-bind="value: Value"/>
		</script>
		<script type="text/html" id="cards">
			<li class="result_box">
				<img id="logoimage" data-bind="attr: {src: $data[$root.resultsLayout()[3].Value()]}" />
				<div class="name">
					<h2 data-bind="text: $data[$root.resultsLayout()[0].Value()]"></h2>
				</div>
				<h4 class="description" data-bind="text: $data[$root.resultsLayout()[1].Value()]"></h4>
				<p data-bind="text: $data[$root.resultsLayout()[2].Value()]"></p> 
			</li>
		</script>			
		<script type="text/html" id="simple">	
			<div class="resultado">
				<div class="image">
					<img id="logoimage" data-bind="attr: {src: $data[$root.resultsLayout()[3].Value()]}" />
				</div>
				<div class="info">
					<h2 data-bind="text: $data[$root.resultsLayout()[0].Value()]"></h2>
					<h4 data-bind="text: $data[$root.resultsLayout()[1].Value()]"></h4>
					<p data-bind="text: $data[$root.resultsLayout()[2].Value()]"></p>
				</div>
			</div>
		</script>			
		<script type="text/html" id="results-sparql">
			{{if $data.hasOwnProperty([$root.resultsLayout()[3].Value()])}}
				<img src="" alt="logo" data-bind="attr: {src: $data[$root.resultsLayout()[3].Value()].value}" />	
			{{/if}}
			{{if $data.hasOwnProperty([$root.resultsLayout()[0].Value()])}}
				<h2 data-bind="text: $data[$root.resultsLayout()[0].Value()].value"></h2>
			{{/if}}
			{{if $data.hasOwnProperty([$root.resultsLayout()[1].Value()])}}
				<h4 data-bind="text: $data[$root.resultsLayout()[1].Value()].value"></h4>
			{{/if}}
			{{if $data.hasOwnProperty([$root.resultsLayout()[2].Value()])}}
				<p data-bind="text: $data[$root.resultsLayout()[2].Value()].value"></p>
			{{/if}}
			<hr>
		</script>
		<script type="text/html" id="new-widgets-template">
			<div data-bind="attr: { 'class': $root.widgetCategory($data.cat) }">
				<h1 data-bind="text: $data.name"></h1>
				<table id="wrapper">
					<tr>
						<td><img data-bind="attr:{src: $data.img}" alt="Widget"/></td>
					</tr>
				</table>
				<div class="mask">
					<h2 data-bind="text: $data.name"></h2>
					<p data-bind="text: $data.description"></p>
					<a href="#" data-bind="click: $data.render"><button class="button">Añadir</button></a>
				</div>
			</div>
		</script>
		<!-- end templates -->

		<!-- THIS MUST BE AT THE END: loads the model-view-viewmodel -->
		<script type='text/javascript' charset="UTF-8" src="js/mvvm.js"></script>
  		<!-- <script src="js/bot_script.js"></script> -->
		<script type="text/javascript" charset="UTF-8" id="sgvzlr_script" src="js/ext/sgvizler.js"></script>

	</body>
</html>