$(document).ready(function() {
  var calcData = new createCalcData();

  var presetCalculate = false;
  var multiplier = false;
  var params = getUrlVars();

  $("#sectionCountOutputs").hide();
  $("#totalCountOutputs").hide();

  if(params.length > 0) {
    if("roadWidth" in params){
      $("#roadWidth").val(calcData.setRoadWidth(parseInt(params["roadWidth"])));
    }

    if("sideSpace" in params){
      $("#sideSpace").val(calcData.setSideSpace(parseInt(params["sideSpace"])));
    }

    if ("mtnHdw" in params) {
        calcData.setMntHdw(parseInt(params["mtnHdw"]));
    }

    if ("humpType" in params) {
        calcData.setHumpType(params["humpType"]);
    }

    if(("sideSpace" in params) && ("roadWidth" in params)){
      presetCalculate = true;
    }

    if("numberOfHumps" in params){
      $("#numberOfHumps").val(calcData.setNumberOfHumps(parseInt(params["numberOfHumps"])));
      multiplier = true;
    }

    if(presetCalculate){
      if(!multiplier)
      {
        calcData.setNumberOfHumps(1);
      }
      
      $("#modal-speed-hump-calc").modal();

      displayCountTotals(calcData);
    }

  }

  $("#humpTypeSelect").change(function () {
    calcData.setHumpType($("#humpTypeSelect").val());
  });

  $("#mntHardwareSelect").change(function () {
    calcData.setMntHdw($("#mntHardwareSelect").val());
  });

  $("#singleAddToCartButton").click(function () {
      getOptionIDs();
    $("#middleQty").val(calcData.middle);
    $("#maleQty").val(calcData.male);
    $.post('/cart', $('#middleAddToCart').serialize())
      .success(function (data) { showAddToCartData(data); })
      .error(function (data) { showAddToCartData(data); });
    $.post('/cart', $('#maleAddToCart').serialize())
      .success(function (data) { showAddToCartData(data); })
      .error(function (data) { showAddToCartData(data); }); 
  });

  $("#totalAddToCartButton").click(function () {
    getOptionIDs();
    $("#middleQty").val(calcData.middleTotal);
    $("#maleQty").val(calcData.maleTotal);
      $.post('/cart/AddToCart', $('#middleAddToCart').serialize())
      .success(function (data) { showAddToCartData(data); })
      .error(function (data) { showAddToCartData(data); });
      $.post('/cart/AddToCart', $('#maleAddToCart').serialize())
      .success(function (data) { showAddToCartData(data); })
      .error(function (data) { showAddToCartData(data); });
      

    //Add SpeedHump Calc added to cart here
    ga('send', 'event', 'SpeedHumpCalc', 'cartAdd', 'Humps Added to Cart');
      
  });

  $('#totalSpeedHump').submit(function() {
    var roadWidthValid = validate("#roadWidth");
    var sideSpaceValid = validate("#sideSpace");
    var numberOfHumpsValid = validate("#numberOfHumps");
    
    if(numberOfHumpsValid && roadWidthValid && sideSpaceValid){
      calcData.setRoadAndSide($("#roadWidth").val(), $("#sideSpace").val());
      calcData.setNumberOfHumps($("#numberOfHumps").val());

      calcData.setMntHdw($("#mntHardwareSelect").val());
      calcData.setHumpType($("#humpTypeSelect").val());

      displayCountTotals(calcData);
    }

    return false;
  });
});

function getOptionIDs() {
    var humpType = $("#humpTypeSelect").val();
    var mntHdw = $("#mntHardwareSelect").val();
    var maleOptionID;   
    var middleOptionID; 
    
    if (humpType == "reg"){
        switch (mntHdw) {
            case "11": //12" spike
                setProdOptionIds(
                3332, //male
                3328); //middle 2433
                break;
            case "80": //5" lag
                setProdOptionIds(
                3333, //male
                3329); //middle 2548
                break;
            case "79": //3" wedge
                setProdOptionIds(
                3334, //male
                3330); //middle 2549
                break;
            case "108": //18" heavy
                setProdOptionIds(
                3335, //male
                3331); //middle 2729
                break;
            default: //Default to 12" spikes
                setProdOptionIds(
                3332, //male
                3328); //middle 2433
                break;
        }
    }

    if (humpType == "heavy"){
            switch (mntHdw) {
                case "11": //12" spike
                    setProdOptionIds(
                    3240, //male
                    2433); //middle 
                    break;
                case "80": //5" lag
                    setProdOptionIds(
                    3241, //male
                    2548); //middle 
                    break;
                case "79": //3" wedge
                    setProdOptionIds(
                    3242, //male
                    2549); //middle 
                    break;
                case "108": //18" heavy
                    setProdOptionIds(
                    3243, //male
                    2729); //middle
                    break;
                default: //Default to 12" spikes
                    setProdOptionIds(
                    3240, //male
                    2433); //middle 
                    break;
            }
    }
}

function setProdOptionIds(male, middle) {
    $("#maleProdOptionID").val(male);
    $("#middleProdOptionID").val(middle);
}

function showAddToCartData(data) {
    $("#modal-speed-hump-calc").modal('hide');
    $('#addToCartResult').append(data);
    $('#addToCartResult').show();
    $('#recommended-products').parent().css('display','none');
}


function validate(selector){
  var value = $(selector).val();
  var returnValue = true;
  if(isNaN(value) || value.trim()=='' || value < 0)
  {
    addValidationError(selector, "Must be a whole number.")
    returnValue = false;
  }
  if (selector == "#roadWidth") {
      if (isNaN(value) || value.trim() == '' || value > -1 && value < 5) {
          addValidationError(selector, "Must be greater than 4ft.")
          returnValue = false;
      }
  }

  if(returnValue){
    removeValidationError(selector);
  }

  return returnValue;
}

function addValidationError(selector,txt){
  $(selector + "-Error").html(txt);
  $(selector + "-Ast").show();
  $(selector).parent().parent(".form-group").addClass("has-error");
}

function removeValidationError(selector){
  $(selector + "-Error").html('');
  $(selector + "-Ast").hide();
  $(selector).parent().parent(".form-group").removeClass("has-error");
}

function displayCountTotals(calcData)
{
  clearDisplay();

  if(calcData.numberOfHumps > 1)
  {
    displaySectionCountTotals(calcData);
  } else {
    $("#sectionCountOutputs").fadeOut();
  }

  displayTotalCountTotals(calcData);

  generateShareUrl(calcData);

  drawVisualDisplay(calcData);

    //Add SpeedHump Calc used here
    ga('send', 'event', 'SpeedHumpCalc', 'computed', 'Values Computed');
  
}

function displaySectionCountTotals(calcData)
{
  $("#sections1Middle").html(calcData.middle);
  $("#sections1Male").html(calcData.male);

  $("#sectionCountOutputs").fadeIn();
}

function displayTotalCountTotals(calcData)
{
  $("#sections2Middle").html(calcData.middleTotal);
  $("#sections2Male").html(calcData.maleTotal);

  $("#totalCountTitleHumpCount").html(calcData.numberOfHumps + ((calcData.numberOfHumps > 1) ? " Speed Humps" : " Speed Hump"));

  $("#totalCountOutputs").fadeIn();

  $("#calculateButton").html("Re-calculate Number of Sections");
}

function generateShareUrl(calcData) {
    //addParams = typeof addParams !== 'undefined' ? addParams : false;
    var hash = "";
    //roadWidth  = 0, sideSpace = 0, numberOfHumps = 0;
    if (window.location.href.indexOf('#') > 0) {
        hash = window.location.href.split('#')[1];
    }

    var url = window.location.href.split('#')[0].split('?')[0];

    if (calcData.showParams) {
        var shareUrl = url + calcData.params + ((hash == "") ? "" : "#" + hash);

        $("#shareUrl").html("<a HREF=\"" + shareUrl + "\">" + shareUrl + "</a>");

        var stateObj = {};
        window.history.pushState(stateObj, "SpeedHump Calclulator - Traffic Safety Store", shareUrl);
    } else {
        $("#shareUrl").html("<a HREF=\"" + url + "\">" + url + "</a>");
    }
}

function getUrlVars()
{
  var vars = [], hash;
  var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
  for(var i = 0; i < hashes.length; i++)
  {
    hash = hashes[i].split('=');
    vars.push(hash[0]);
    vars[hash[0]] = hash[1];
  }
  return vars;
}

function drawVisualDisplay(calcData)
{
  var displayArea = $("#visualDisplay");

  var numberDisplayed = ((calcData.numberOfHumps > 10) ? 10 : calcData.numberOfHumps);

  var widthIncrement = ((displayArea.width())/(parseInt(numberDisplayed) + 1));

  var verticalMargin = (displayArea.height()*(parseInt(calcData.sideSpace)/((parseInt(calcData.roadWidth)*12)+parseInt(calcData.sideSpace))))/2;
  var dx = widthIncrement;
  var dy = verticalMargin;

  for(j=0; j < numberDisplayed; j++)
  {
    if(j >= 10){


    }else {
      drawSpeedHump(dx-15,dy,calcData.middle);
      dx += widthIncrement;
    }
  }

  $(".sh-section").fadeIn();

  if(numberDisplayed < calcData.numberOfHumps){
    showTooManyMsg();
  }
}

function showTooManyMsg(){
  $("#visualDisplay").append("<div id=\"tooManyMsg\" style=\"width:"+$("#visualDisplay").width()+"px;display:none;\">Your totals are updated, but only 10 speedhumps fit on our sample road.</div>");
  $("#tooManyMsg").fadeIn(600, function () {
    $(this).delay(5500).fadeOut(600);
  });
}

function clearDisplay(){
  $("#visualDisplay").html("");
}

function drawSpeedHump(x, y, middleCount)
{
  var displayArea = $("#visualDisplay");

  var sectionHeight = (displayArea.height() - (y*2))/(middleCount + 2);

  var dx = x;
  var dy = y;

  drawSection(dx, dy, sectionHeight, "sh-male");

  dy += sectionHeight;

  for(i=1; i <= middleCount; i++){
    drawSection(dx,dy,sectionHeight, "sh-middle");
    dy += sectionHeight;
  }

  drawSection(dx, dy, sectionHeight, "sh-female");
}

function drawSection(x, y, height, css){
  var aspectRatio = (35/20);
  var maleEndCapMarkUp = "<div class=\"sh-section "+css+"\" style=\"top:"+y+"px;left:"+x+"px;height:"+height+"px;width:"+((aspectRatio*height > 50) ? 50 : (aspectRatio*height))+"px;display:none;\"></div>";
  $("#visualDisplay").append(maleEndCapMarkUp);
}

function createCalcData(){
  //middleCount, maleCount, femaleCount){
  this.roadWidth = 0;
  this.sideSpace = 0;
  this.numberOfHumps = 1;
  this.mtnHdwDefault = $("#mntHardwareSelect").val();
  this.mntHdw = this.mtnHdwDefault;
  this.showParams = true;
  this.humpType = "reg";
  checkForHumpType(this);

  setAll(this);

  this.setRoadWidth = function(roadWidth){
    this.roadWidth = roadWidth;

    setAll(this);

    return this.roadWidth;
  }

  this.setSideSpace = function(sideSpace){
    this.sideSpace = sideSpace;

    setAll(this);
    return this.sideSpace;
  }

  this.setMntHdw = function (mntHdw) {
      if (this.mntHdw != mntHdw) {

          $("#mntHardwareSelect").val(validateMntHdw(mntHdw));
          this.mntHdw = mntHdw;
      }

      setAll(this);
      return this.mntHdw;
  }

  checkForMntHdw(this);

  this.setHumpType = function (humpType, update = true) {
      if (this.humpType != humpType) {
          $("#humpTypeSelect").val(humpType);
          this.humpType = humpType;
      }

      if (update) {
          setAll(this);
      }
      return this.humpType;
  }

  this.setRoadAndSide = function(roadWidth, sideSpace){
    this.roadWidth = parseInt(roadWidth);
    this.sideSpace = parseInt(sideSpace);

    setAll(this);
  }

  this.setShowParams = function (sParams) {
      this.showParams = sParams;
  }

  function validateMntHdw(mntHdw) {
      var retval = mntHdw;
      var availMntHdw = $('#mntHardwareSelect').children('option').map(function (i, e) {
          return e.value;
      }).get();

      if (availMntHdw.indexOf(mntHdw) < 0) {
          retval = availMntHdw[0];
      }

      return retval;
  }

  function setSectionCount(calcData){
    calcData.middle = Math.round(((calcData.roadWidth*12)-(calcData.sideSpace*2)-39)/19.5);
    calcData.male = 1;
    //calcData.female = 1;
  }

  this.setNumberOfHumps = function(numberOfHumps){
    this.numberOfHumps = parseInt(numberOfHumps);

    setTotalCount(this);
    setParams(this);

    return this.numberOfHumps;
  }

  function setTotalCount(calcData){
    calcData.middleTotal = calcData.middle * calcData.numberOfHumps;
    calcData.maleTotal = calcData.male * calcData.numberOfHumps;
    //calcData.femaleTotal = calcData.female * calcData.numberOfHumps;
  }
  function checkForMntHdw(calcData) {
      var selectedHDW = $("select[name='option_2']").val();

      if (selectedHDW != undefined) {
          calcData.setMntHdw(selectedHDW);
          $("select[name='option_2']").change(function (calcData) {
              $("#mntHardwareSelect").val($("select[name='option_2']").val());
          });
      }
  }

  function checkForHumpType(calcData) {
      var retval = "reg";

      var IPN = $("#InternalProductNumber").val();
      if (IPN != undefined) {
          calcData.showParams = false;
          if (IPN.indexOf("SHHD") > -1) {
              retval = "heavy";
          }
      }

      $("#humpTypeSelect").val(retval);
      calcData.humpType = retval;
  }

  function setParams(calcData){
    var params = ""
      var first = true;

      if(calcData.roadWidth != 0)
      {
        if(first){
          params = params + "?";
          first = false;
        } else {
          params = params + "&";
        }
        
        params = params + "roadWidth=" + calcData.roadWidth;
      }

      if (calcData.sideSpace != undefined && calcData.sideSpace != 0)
      {
        if(first){
          params = params + "?";
          first = false;
        } else {
          params = params + "&";
        }

        params = params + "sideSpace=" + calcData.sideSpace;
      }

      if(calcData.numberOfHumps != 1)
      {
        if(first){
          params = params + "?";
          first = false;
        } else {
          params = params + "&";
        }

        params = params + "numberOfHumps=" + calcData.numberOfHumps;
      }

      if (calcData.humpType != "reg")
      {
          if (first) {
              params = params + "?";
              first = false;
          } else {
              params = params + "&";
          }

          params = params + "humpType=" + calcData.humpType;
      }

      if (calcData.mntHdw != calcData.mntHdwDefault) {
          if (first) {
              params = params + "?";
              first = false;
          } else {
              params = params + "&";
          }

          params = params + "mntHdw=" + calcData.mntHdw;
      }

      calcData.params = params;
  }

  function setAll(calcData){
    setSectionCount(calcData);
    setTotalCount(calcData);
    setParams(calcData);
    generateShareUrl(calcData);
  }
};