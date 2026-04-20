<div class="row">
    @if(lang('ar'))
        <div class="remaining-width">
        <input class="form-control" name="phone" value="{{ old('phone', $value ?? '') }}" onkeypress="return AllowOnlyNumbers(event);" required type="number">
        </div>
    @endif
    <div class="fixed-width">
        <div class="phone">
          <div id="phone" class="select text-center"><i class="flagstrap-icon flagstrap-{{ strtolower(country_code()) }}"></i><span class="mx-1">{{ phone_code() }}</span></div>
          <div id="phone-drop" class="dropdown">
            <ul style="padding: 0px 10px;">
                 <li data-code="BH" data-name="Bahrain" data-cid="c47"><i class="flagstrap-icon"></i><span class="mx-1">973</span></li>
                 <li data-code="SA" data-name="Saudi Arabia" data-cid="c216"><i class="flagstrap-icon"></i><span class="mx-1">966</span></li>
                 <li data-code="AE" data-name="United Arab Emirates" data-cid="c253"><i class="flagstrap-icon"></i><span class="mx-1">971</span></li>
                 <li data-code="OM" data-name="Oman" data-cid="c188"><i class="flagstrap-icon"></i><span class="mx-1">968</span></li>
                 <li data-code="QA" data-name="Qatar" data-cid="c201"><i class="flagstrap-icon"></i><span class="mx-1">974</span></li>
                 <li data-code="KW" data-name="Kuwait" data-cid="c140"><i class="flagstrap-icon"></i><span class="mx-1">965</span></li>
                 <li data-code="EG" data-name="Egypt" data-cid="c93"><i class="flagstrap-icon"></i><span class="mx-1">20</span></li>
            </ul>
          </div>
        </div>
        <input type="hidden" name="phone_code" id="phone_code" value="{{ phone_code() }}">
        <input type="hidden" name="country_code" id="country_code" value="{{ country_code() }}">
    </div>
    @if(lang('en'))
        <div class="remaining-width">
         <input class="form-control" name="phone" value="{{ old('phone', $value ?? '') }}" onkeypress="return AllowOnlyNumbers(event);" required type="number">
        </div>
    @endif
</div>


@push('css')
<style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    input[type="number"] {
        -moz-appearance: textfield;
    }
    
    .fixed-width {
        width: 120px;
    }
    
    .remaining-width {
        width: calc(100% - 120px);
    }

    ul {
         list-style: none;
         box-sizing: border-box;
         margin: 0;
         padding: 0;
    }
    input[name="phone"]{
         border-radius: 0px;
    }
     .phone {
         font-size: 15px;
         position: relative;
         margin: 0 auto;
         width: 400px;
         max-width: 100%;
         border: var(--bs-border-width) solid var(--bs-border-color);
         border-radius: 0px;
    }
     .phone .select {
         height: 37px !important;
         position: relative;
         height: 40px;
         line-height: 40px;
         background: #fff;
         white-space: nowrap;
         text-overflow: ellipsis;
         overflow: hidden;
         cursor: pointer;
    }
     .phone .select .flagstrap-icon {
         box-sizing: border-box;
         display: inline-block;
         margin-right: 10px;
         width: 16px;
         height: 11px;
         background-image: url("https://raw.githubusercontent.com/blazeworx/flagstrap/master/dist/css/flags.png");
         background-repeat: no-repeat;
         background-color: #e3e5e7;
    }
    
    
    .phone .select .flagstrap-icon.flagstrap-bh {
         background-position: -96px -11px;
    }
    .phone .dropdown .flagstrap-icon.flagstrap-bh {
         background-position: -96px -11px;
    }

    .phone .select .flagstrap-icon.flagstrap-sa {
         background-position: 0 -132px;
    }
    .phone .dropdown .flagstrap-icon.flagstrap-sa {
         background-position: 0 -132px;
    }
    
    .phone .select .flagstrap-icon.flagstrap-ae {
         background-position: -32px 0;
    }
    .phone .dropdown .flagstrap-icon.flagstrap-ae {
         background-position: -32px 0;
    }
    
    .phone .dropdown .flagstrap-icon.flagstrap-om {
         background-position: -176px -110px;
    }
    .phone .select .flagstrap-icon.flagstrap-om {
         background-position: -176px -110px;
    }
    
    .phone .dropdown .flagstrap-icon.flagstrap-qa {
         background-position: -160px -121px;
    }
    .phone .select .flagstrap-icon.flagstrap-qa {
         background-position: -160px -121px;
    }
    
    .phone .dropdown .flagstrap-icon.flagstrap-kw {
         background-position: -176px -77px;
    }
    .phone .select .flagstrap-icon.flagstrap-kw {
         background-position: -176px -77px;
    }
    
    .phone .dropdown .flagstrap-icon.flagstrap-eg {
         background-position: -208px -33px;
    }
    
    .phone .select .flagstrap-icon.flagstrap-eg {
         background-position: -208px -33px;
    }
    
    
     .phone .select:after {
         content: "";
         display: block;
         position: absolute;
         top: 18px;
         right: 20px;
         width: 8px;
         height: 5px;
    }
     .phone .select.open:after {
         background-position: 0 -5px;
    }
     .phone .dropdown {
         display: none;
         position: absolute;
         top: 39px;
         left: 0;
         width: 100%;
         height: 225px;
         border: 1px solid #cfcfcf;
         border-top: 1px solid #a6a6a6;
         background: #fff;
         box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
         overflow-y: scroll;
         z-index: 1;
    }
     .phone .dropdown .flagstrap-icon {
         box-sizing: border-box;
         display: inline-block;
         margin-right: 10px;
         width: 16px;
         height: 11px;
         background-image: url("https://raw.githubusercontent.com/blazeworx/flagstrap/master/dist/css/flags.png");
         background-repeat: no-repeat;
         background-color: #e3e5e7;
    }
  
     .phone .dropdown .flagstrap-icon {
         vertical-align: middle;
    }
     .phone .dropdown li {
        /*padding: 0 20px;
        */
         line-height: 34px;
         font-size: 13px;
         font-weight: 400;
         color: #828282;
         cursor: pointer;
    }
     .phone .dropdown li:first-child {
         margin-top: 12px;
    }
     .phone .dropdown li:last-child {
         margin-bottom: 12px;
    }
     .phone .dropdown li:hover {
         background: #dedede;
         color: #454545;
    }
     .phone .dropdown li.open {
         display: block;
    }

</style>
@endpush

@push('js')
<script>
    function phoneDropdown(seletor) {
      var Selected = $(seletor);
      var Drop = $(seletor + "-drop");
      var DropItem = Drop.find("li");
    
      Selected.click(function () {
        Selected.toggleClass("open");
        Drop.toggle();
      });
    
      Drop.find("li").click(function () {
        Selected.removeClass("open");
        Drop.hide();
        $('#phone_code').val($(this).find('span').html());
        $('#country_code').val($(this).attr('data-code'));
        var item = $(this);
        Selected.html(item.html());
      });
      DropItem.each(function () {
        var code = $(this).attr("data-code");
        if (code != undefined) {
          var phoneCode = code.toLowerCase();
          $(this).find("i").addClass("flagstrap-" + phoneCode);
        }
      });
    }
    
    phoneDropdown("#phone");

    
    function AllowOnlyNumbers(e) {
      e = (e) ? e : window.event;
    
      var clipboardData = e.clipboardData ? e.clipboardData : window.clipboardData;
      var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
      var str = (e.type && e.type == "paste") ? clipboardData.getData('Text') : String.fromCharCode(key);
    
      return (/^\d+$/.test(str));
    }
</script>
@endpush