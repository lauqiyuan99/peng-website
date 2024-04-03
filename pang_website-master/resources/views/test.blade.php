<div class="container">
        <div class="scroller scroller-left">
            <i class="fa fa-chevron-left"></i>
        </div>
        <div class="scroller scroller-right">
            <i class="fa fa-chevron-right"></i>
        </div>
        <div class="wrapper">
            <ul class="nav nav-tabs list" id="myTab">
                @for($year = 1971; $year <= 2021; $year++)
                    <!-- <li class="active"><a href="#home">Home</a></li> -->
                    <li><a href="#{{ $year }}">{{ $year }}</a></li>
                @endfor
            </ul>
        </div>
    </div>

    <style>
        .wrapper {
            position:relative;
            margin:0 auto;
            overflow:hidden;
            padding:5px;
            height:50px;
        }

        .list {
            position:absolute;
            left:0px;
            top:0px;
            min-width:3000px;
            margin-left:12px;
            margin-top:0px;
        }

        .list li{
            display:table-cell;
            position:relative;
            text-align:center;
            cursor:grab;
            cursor:-webkit-grab;
            color:#efefef;
            vertical-align:middle;
        }

        .scroller {
            text-align:center;
            cursor:pointer;
            display:none;
            padding:7px;
            padding-top:11px;
            white-space:no-wrap;
            vertical-align:middle;
            background-color:#fff;
        }

        .scroller-right{
            float:right;
        }

        .scroller-left {
            float:left;
        }
    </style>
  
    <script>
        var hidWidth;
        var scrollBarWidths = 40;

        var widthOfList = function(){
            var itemsWidth = 100;
            $('.list li').each(function(){
                var itemWidth = $(this).outerWidth();
                itemsWidth+=itemWidth;
            });
            return itemsWidth;
        };

        var widthOfHidden = function(){
            return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
        };

        var getLeftPosi = function(){
            return $('.list').position().left;
        };

        var reAdjust = function(){
            if (($('.wrapper').outerWidth()) < widthOfList()) {
                $('.scroller-right').show();
            }
            else {
                $('.scroller-right').hide();
            }
            
            if (getLeftPosi()<40) {
                $('.scroller-left').show();
            }
            else {
                $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
                $('.scroller-left').hide();
            }
        }

        reAdjust();

        $(window).on('resize',function(e){  
            reAdjust();
        });

        $('.scroller-right').click(function() {
            $('.scroller-left').fadeIn('slow');
            $('.scroller-right').fadeOut('slow');
            
            $('.list').animate({left:"+="+widthOfHidden()+"px"},'slow',function(){

            });
        });

        $('.scroller-left').click(function() {
            $('.scroller-right').fadeIn('slow');
            $('.scroller-left').fadeOut('slow');
        
            $('.list').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){
            
            });
        });    
    </script>