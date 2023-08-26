@extends('layouts.master')
@section('page-title')
Share Scholars
@endsection
@section('content')
<style>

    .form-control.error {
        border-color: red !important;
    }
    .error {
        color: red !important;
    }
    .fontJameel{
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Share Scholars</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-lg-12 form-group text-right top_search">
                    <a href="/" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form id="shareScholars">
                            <div class="form-group row">
                                <div class="col-md-3 col-sm-3">
                                    <label class="control-label fs18">Select Type <span class="text-danger">*</span></label>
                                    <select class="form-control" id="bd" name="bd">
                                        <option value="2">Death's</option>
                                        <option value="1">Birth's</option>
                                    </select>

                                    @error('type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label class="control-label fs18">Day </label>
                                    <select class="form-control" id="day" name="day">
                                        <option value="">Select Day</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                    </select>

                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label class="control-label fs18">Months </label>
                                    <select class="form-control" id="month" name="month">
                                        <option value="">Select Month</option>
                                        <option value="01">Muharram</option>
                                        <option value="02">Safar</option>
                                        <option value="03">Rabi al-Awwal</option>
                                        <option value="04">Rabi al-Thānī</option>
                                        <option value="05">Jumada al-Awwal</option>
                                        <option value="06">Jumada al-Thani</option>
                                        <option value="07">Rajab</option>
                                        <option value="08">Shaʿban</option>
                                        <option value="09">Ramadan</option>
                                        <option value="10">Shawwal</option>
                                        <option value="11">Dhu al-Qaʿdah</option>
                                        <option value="12">Dhu al-Hijjah</option>
                                    </select>

                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label class="control-label fs18">Year </label>
                                    <input type="text" class="form-control" placeholder="Year" id="year" name="year"
                                        value="{{ old('year') }}">

                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" id="formSubmit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row mb-5" style="display: block;">
                <a href="javascript:void;" class="btn btn-success" id="copyButton">Copy to Clipboard</a>
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_content">
                        <div id="textToCopy"  class="text-right fontJameel" dir="rtl">

                        </div>
                    </div>
                </div>
                <span id="copyResult"></span>
            </div>
        </div>
        <br>
<br>
<br>
<br>
    </div>
</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
<script src="/assets/js/jquery.stringtoslug.min.js"></script>
<script type="text/javascript" src="https://scholars.pk/ziaetaiba/assets/js/isfontavailable.js"></script>


   <script type="text/javascript">

    jQuery(document).ready( function () {
        var font = 'Jameel Noori Nastaleeq';
        var fontAvailability = isFontAvailable( font );
    	if (!fontAvailability) {
			$("head").prepend("<style type=\"text/css\">" +
			    "@font-face {\n" +
			        "\tfont-family: \"Jameel Noori Nastaleeq\";\n" +
			        "\tsrc: url('/public/fonts/Jameel Noori Nastaleeq.ttf');\n" +
			    "}\n" +
			"</style>");
		}
	});
    </script>

<style>
	.fontJameel{
		font-family: 'Jameel Noori Nastaleeq' !important;
        font-size: 22px;
        margin-bottom: 20px;
	}
</style>
    <script>
    $('#shareScholars').on('submit',function(e){
        e.preventDefault();

        document.getElementById("textToCopy").innerHTML = '';
        let bd = $('#bd').val();
        let day = $('#day').val();
        let month = $('#month').val();
        let year = $('#year').val();
        let islamicMonths = ["","محرم الحرام","صفر المظفر","ربیع الاول","ربیع الثانی","جمادی الاولی","جمادی الثانی","رجب المرجب","شعبان المعظم","رمضان المبارك","شوال المکرم","ذیقعدہ","ذوالحجہ"]
        $.ajax({
          url: "/share-scholars-ajax",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            bd:bd,
            day:day,
            month:month,
            year:year,
          },
          success:function(response){
            if(response.length){

            newMonth = parseInt(month);
            var html = '<p>یوم وصال:<br> '+day+' '+islamicMonths[newMonth]+'</p>';
            html += '<p>📖 بزرگانِ دین فرماتے ہیں: جہاں  صالحین (نیک بندوں)  کا ذکر ہوتا ہے وہاں اللہ کی رحمت نازل ہوتی ہے۔</p><br>';
            response.forEach(function(item) {
                html += '<p>*🪔'+item.name+'*</p><br>';
            });
            html += '<p> 🔎 مزید معلومات اور تفصیل کے لیے دیے گئے لنک کو ملاحظہ فرمائیں  👇<br> <a target="_blank" href="https://scholars.pk/ur/scholar/gotodate?bd='+bd+'&day='+day+'&month='+month+'&year='+year+'">https://scholars.pk/ur/scholar/gotodate?bd='+bd+'&day='+day+'&month='+month+'&year='+year+'</a></p>';
            html += '<p>📿 اِن کے لیے ایصالِ ثواب کا اہتمام فرمائیں اور دعا کریں کہ اللہ تبارک و تعالیٰ ہمیں اِن کے نقشِ قدم پر چلتے ہوئے خدمتِ دین و ملّت کی توفیقِ رفیق عطا فرمائے۔🤲</p>';
            }
            else{
                html = 'No Record Found';
            }

            document.getElementById("textToCopy").innerHTML = html;
          },
         });
        });
        const answer = document.getElementById("copyResult");
        const copy   = document.getElementById("copyButton");
        const selection = window.getSelection();
        const range = document.createRange();
        const textToCopy = document.getElementById("textToCopy");

        copy.addEventListener('click', function(e) {
            range.selectNodeContents(textToCopy);
            selection.removeAllRanges();
            selection.addRange(range);
            const successful = document.execCommand('copy');
            if(successful){
            answer.innerHTML = 'Text Copied';
            } else {
            answer.innerHTML = 'Unable to copy!';
            }
            window.getSelection().removeAllRanges()
        });
      </script>
@endsection
