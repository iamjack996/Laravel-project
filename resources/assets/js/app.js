
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });



$(document).ready(function(){

  $("#get").click(function(e){


        e.preventDefault();

        $.ajax({
          type: "GET",
          url: "json",
          dataType: 'json',
          success: function(data){

            console.log(data);
            var problem = data.problem;
            for(var i=0 ; i < problem.length ; i++){
              var item =
              '<div>Name : '+problem[i].problem_name+ '</div>'+
              '<div>Email : '+problem[i].problem_mail+ '</div>'+
              '<div>Title : '+problem[i].problem_title+ '</div>'+
              '<div>Content : '+problem[i].problem_content+ '</div>'+
              '<div>Kind : '+problem[i].problem_kind+ '</div>'+
              '<div>Time : '+problem[i].problem_time+ '</div>'+'<hr>';
              $('#show').append(item);
            }
          }
        });
});

    $("#try").click(function(e){
        // $(this).remove();
        e.preventDefault();
        $("#msg").append(1234567891111).hide().fadeIn(2500);
    });

      $("#form").submit(function(e){
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
          e.preventDefault();

          $.ajax({
            type:"POST",
            url:"/test",
          //  contentType: "application/json; charset=utf-8",
            dataType:"json",
            data: $("#form").serialize(),
            // data:{_token: '{{csrf_token()}}'},
            success: function(data){
              console.log(data);
              // $("#msg").html(<b>恭喜成功回報，感謝</b>);
            }


          });

      });


      $("#forlocation").click(function(e){
        $('#preventshow').empty();
        $('#showtab').empty();

        e.preventDefault();

        $.ajax({
          type: "GET",
          url: "Btnforlocation",
          dataType: 'json',
          success: function(data){
            console.log(data);
            var article = data.article;
            for(var i=0 ; i < article.length ; i++){
              var item =
              '<tr>'+
              '<th><input type="checkbox" name="articleid[]" value="'+article[i].id+'"></th>'+
              '<th><a href="/updatearticle/'+article[i].id+'">'+article[i].title+ '</th>'+
              '<th>'+article[i].type+ '</th>'+
              '<th>'+article[i].company+ '</th>'+
              '<th>'+article[i].detail+ '</th>'+
              '<th>'+article[i].deadline+ '</th>'+
              '<th>'+article[i].location+ '</th>'+
              '</tr>';
              $('#showtab').append(item);
            }
            $('#count').empty();
            $('#count').append("實習貼文數 : "+data.count);
          }
        })
      });

      // 0915開會後更改

      // $("#forlocation2").click(function(e){
      //   $('#preventshow2').empty();
      //   $('#showtab2').empty();
      //
      //   e.preventDefault();
      //
      //   $.ajax({
      //     type: "GET",
      //     url: "/Btnforlocation",
      //     dataType: 'json',
      //     success: function(data){
      //       console.log(data);
      //       var article = data.article;
      //       for(var i=0 ; i < article.length ; i++){
      //         var item =
      //         '<h2>'+article[i].title+'　<sub>　by '+'<a href="/company/'+article[i].user_id+'">'+article[i].company+'</a></sub></h2>'+
      //         '<p><var>'+article[i].type+'</var></p>'+
      //         '<p>位於'+article[i].location+'</p>'+
      //         '<p>待遇$'+article[i].salt+'</p>'+
      //         '<p>需求人數'+article[i].numofpeople+'</p>'+
      //         '<p>'+article[i].content+'</p>'+
      //         '<a href="/detail/'+article[i].id+'">More..</a>'+
      //         '<p align="right">發布於'+article[i].created_at +' '+article[i].numofapply +'人應徵 '+article[i].numoflike +'人收藏</p>'+
      //         '<hr>';
      //         $('#showtab2').append(item);
      //       }
      //     }
      //   })
      // });

      $("#forlocation2").click(function(e){
        e.preventDefault();
        $('#preventshow2').empty();
        $('#showtab2').empty();

        console.log(111);
        $.ajax({
          type: "GET",
          url: "/Btnforlocation2",
          dataType: 'html',
          success :function(data){
            console.log(22);
            $("#preventshow2").html(data);
          }
        })
      });

      // $("#forlocation2").click(function(e){
      //   e.preventDefault();
      //   $('#preventshow2').empty();
      //   $('#showtab2').empty();
      //
      //   $.ajax({
      //     type: "GET",
      //     url: "/Btnforlocation2",
      //     dataType: 'html',
      //   }).done(function(data){
      //     console.log(22);
      //     $("#preventshow2").html(data);
      //   });
      // });

      $(".pagination a").click(function(e){
        e.preventDefault();
        $('#preventshow2').empty();
        $('#showtab2').empty();

        var pagefor = ($(this).attr('href').split('page=')[0]);
        var page = ($(this).attr('href').split('page=')[1]);
        console.log(pagefor);
        if(pagefor=='location/allintern?'){
          getforloca(page);
        }else{
          getajaxpage(page);
        }
      });

      function getajaxpage(page){

        $.ajax({
          async: true,
          url: "/ajaxpage?page="+page
        }).done(function(data){
          // console.log(page);
          $('#preventshow2').html(data);
        });

      }
      function getforloca(page){

        $.ajax({
          async: true,
          url: "/Btnforlocation2?page="+page
        }).done(function(data){
          // console.log(page);
          $('#preventshow2').html(data);
        });

      }

      // 0915開會後更改end


      $("#fordeadline").click(function(e){
        $('#preventshow').empty();
        $('#showtab').empty();
        e.preventDefault();

        $.ajax({
          type: "GET",
          url: "Btnfordeadline",
          dataType: 'json',
          success: function(data){
            console.log(data);
            var deadline = data.deadline;
            for(var i=0 ; i < deadline.length ; i++){
              var item =
              '<tr>'+
              '<th><input type="checkbox" name="articleid[]" value="'+deadline[i].id+'"></th>'+
              '<th><a href="/updatearticle/'+deadline[i].id+'}}">'+deadline[i].title+ '</th>'+
              '<th>'+deadline[i].type+ '</th>'+
              '<th>'+deadline[i].company+ '</th>'+
              '<th>'+deadline[i].detail+ '</th>'+
              '<th>'+deadline[i].deadline+ '</th>'+
              '<th>'+deadline[i].location+ '</th>'+
              '</tr>';
              $('#showtab').append(item);
            }
            $('#count').empty();
            $('#count').append("實習貼文數 : "+data.count);
          }
        })
      });

      $("#forlasttime").click(function(e){
        $('#preventshow').empty();
        $('#showtab').empty();
        e.preventDefault();

        $.ajax({
          type: "GET",
          url: "Btnforlasttime",
          dataType: 'json',
          success: function(data){
            console.log(data);
            var lasttime = data.lasttime;
            for(var i=0 ; i < lasttime.length ; i++){
              var item =
              '<tr>'+
              '<th><input type="checkbox" name="articleid[]" value="'+lasttime[i].id+'"></th>'+
              '<th><a href="/updatearticle/'+lasttime[i].id+'}}">'+lasttime[i].title+ '</th>'+
              '<th>'+lasttime[i].type+ '</th>'+
              '<th>'+lasttime[i].company+ '</th>'+
              '<th>'+lasttime[i].detail+ '</th>'+
              '<th>'+lasttime[i].deadline+ '</th>'+
              '<th>'+lasttime[i].location+ '</th>'+
              '</tr>';
              $('#showtab').append(item);
            }
            $('#count').empty();
            $('#count').append("實習貼文數 : "+data.count);
          }
        })
      });


      $("#login").one("click",function(e){
        e.preventDefault();
        $("#test").append("登入失敗！");
      });


      $("#search").click(function(e){
        $('#preventshow').empty();
        $('#showtab').empty();
        e.preventDefault();

        $.ajax({
          type:"GET",
          url:"/search",
          dataType:"json",
          data: {ans:$("#find").val()},
          success: function(data){
            console.log(data);
            var article = data.article;
            for(var i=0 ; i < article.length ; i++){
              var item =
              '<tr>'+
              '<th><input type="checkbox" name="articleid[]" value="'+article[i].id+'"></th>'+
              '<th><a href="/updatearticle/'+article[i].id+'">'+article[i].title+ '</th>'+
              '<th>'+article[i].type+ '</th>'+
              '<th>'+article[i].company+ '</th>'+
              '<th>'+article[i].detail+ '</th>'+
              '<th>'+article[i].deadline+ '</th>'+
              '<th>'+article[i].location+ '</th>'+
              '</tr>';
              $('#showtab').append(item);
            }
          }
        })
     });

     $("#search2").click(function(e){
       $('#preventshow2').empty();
       $('#showtab2').empty();
       e.preventDefault();
       $.ajax({
         type:"GET",
         url:"/searchselect2",
         dataType:"json",
         data: {ans1:$("#cityshow2").val(),ans2:$("#typeshow2").val(),ans3:$("#keywordindex").val()},
         success: function(data){
           console.log(data);
           var article = data.article;
           for(var i=0 ; i < article.length ; i++){
             var item =
             '<h2>'+article[i].title+'　<sub>　by '+'<a href="/company/'+article[i].user_id+'">'+article[i].company+'</a></sub></h2>'+
             '<p><var>'+article[i].type+ '</var></p>'+
             '<p>位於'+article[i].location+ '</p>'+
             '<p>待遇$'+article[i].salt+'</p>'+
             '<p>需求人數'+article[i].numofpeople+ '</p>'+
             '<p>'+article[i].content+ '</p>'+
             '<a href="/detail/'+article[i].id+'">More..</a>'+
             '<p align="right">發布於'+article[i].created_at +' '+article[i].numofapply +'人應徵 '+article[i].numoflike +'人收藏</p>'+
             '<hr>';
             $('#showtab2').append(item);
           }
         }
       })
    });

    $("#typeshow2,#cityshow2").change(function(e){
      $('#preventshow2').empty();
      $('#showtab2').empty();
      e.preventDefault();
      $.ajax({
        type: "GET",
        url: "/searchselect2",
        dataType: "json",
        data: {ans1:$("#cityshow2").val(),ans2:$("#typeshow2").val(),ans3:$("#keywordindex").val()},
        success: function(data){
          console.log(data);
          var article = data.article;
          for(var i=0 ; i < article.length ; i++){
            var item =
            '<h2>'+article[i].title+'　<sub>　by '+'<a href="/company/'+article[i].user_id+'">'+article[i].company+'</a></sub></h2>'+
            '<p><var>'+article[i].type+ '</var></p>'+
            '<p>位於'+article[i].location+ '</p>'+
            '<p>待遇$'+article[i].salt+'</p>'+
            '<p>需求人數'+article[i].numofpeople+ '</p>'+
            '<p>'+article[i].content+ '</p>'+
            '<a href="/detail/'+article[i].id+'">More..</a>'+
            '<p align="right">發布於'+article[i].created_at +' '+article[i].numofapply +'人應徵 '+article[i].numoflike +'人收藏</p>'+
            '<hr>';
            $('#showtab2').append(item);
        }
      }
     })

    });


     $("#cityshow").change(function(e){
       $('#preventshow').empty();
       $('#showtab').empty();
       e.preventDefault();
       $.ajax({
         type:"GET",
         url:"/searchselect",
         dataType:"json",
         data: {ans1:$("#cityshow").val(),ans2:$("#typeshow").val()},
         success: function(data){
           console.log(data);
           var article = data.article;
           for(var i=0 ; i < article.length ; i++){
             var item =
             '<tr>'+
             '<th><input type="checkbox" name="articleid[]" value="'+article[i].id+'"></th>'+
             '<th><a href="/updatearticle/'+article[i].id+'">'+article[i].title+ '</th>'+
             '<th>'+article[i].type+ '</th>'+
             '<th>'+article[i].company+ '</th>'+
             '<th>'+article[i].detail+ '</th>'+
             '<th>'+article[i].deadline+ '</th>'+
             '<th>'+article[i].location+ '</th>'+
             '</tr>';
             $('#showtab').append(item);
           }
           $('#count').empty();
           $('#count').append("實習貼文數 : "+data.count);
         }
       })

     });

     $("#typeshow").change(function(e){
       $('#preventshow').empty();
       $('#showtab').empty();
       e.preventDefault();
       $.ajax({
         type: "GET",
         url: "/searchselect",
         dataType: "json",
         data: {ans1:$("#cityshow").val(),ans2:$("#typeshow").val()},
         success: function(data){
           console.log(data);
           var article = data.article;
           for(var i=0 ; i < article.length ; i++){
             var item =
             '<tr>'+
             '<th><input type="checkbox" name="articleid[]" value="'+article[i].id+'"></th>'+
             '<th><a href="/updatearticle/'+article[i].id+'">'+article[i].title+ '</th>'+
             '<th>'+article[i].type+ '</th>'+
             '<th>'+article[i].company+ '</th>'+
             '<th>'+article[i].detail+ '</th>'+
             '<th>'+article[i].deadline+ '</th>'+
             '<th>'+article[i].location+ '</th>'+
             '</tr>';
             $('#showtab').append(item);
         }
         $('#count').empty();
         $('#count').append("實習貼文數 : "+data.count);
       }
      })

     });


      $("#close").click(function(e){
        e.preventDefault();
        window.close();
      });

      $("#foruser").click(function(e){
        e.preventDefault();
        $("#original").empty();
        $("#results").empty();

        $.ajax({
          type: "GET",
          url: "/foruser",
          dataType: "json",
          data: {ans1:$("#companyid").val()},
          success: function(data){
            console.log(data);
            var notice = data.notice;
            var x = "";
            var y = "";
            for(var i=0 ; i < notice.length ; i++){ //url 有問題
              if(notice[i].towho == 'applyer'){x='To ';y='再通知'}else{x='From ';y='回覆'}
              var item =
              '<form action="{{ url(\'/companynoticeget/\'.'+notice[i].user+') }}" method="post" target="_blank" class="noticeform" enctype="multipart/form-data">'+
                '<input type="hidden" id="userid" value="'+notice[i].user+'">'+
                '<input type="hidden" id="company_id" name="company_id" value="'+notice[i].company_id+'">'+
                '<input type="hidden" id="article_id" name="article_id" value="'+notice[i].article_id+'">'+
                '<input type="hidden" id="towho" name="towho" value="'+notice[i].towho+'">'+
                '<table style="width:90%" border="1px solid black">'+
                  '<tr>'+
                    '<th>'+x+notice[i].name+'</th>'+
                    '<th>'+notice[i].atitle+'</th>'+
                    '<th>'+notice[i].ntitle+'</th>'+
                    '<th>'+notice[i].content+'</th>'+
                    '<th>'+notice[i].created_at+'</th>'+
                    '<th><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="submit" name="submit" value="'+y+'"></th>'+
                  '</tr>'+
                '</table>'+
              '</form>';
              $("#results").append(item);
            }

          }
        })
      });

      $("#titleselect").change(function(e){
        e.preventDefault();
        $("#original").empty();
        $("#results").empty();

        $.ajax({
          type: "GET",
          url: "/fortitleselect",
          dataType: "json",
          data: {ans1:$("#companyid").val(),ans2:$("#titleselect").val()},
          success: function(data){
            console.log(data);
            var x = "";
            var notice = data.notice;
            for(var i=0 ; i < notice.length ; i++){ //url 有問題
              if(notice[i].towho == 'applyer'){x='To ';y='再通知'}else{x='From ';y='回覆'}
              var item =
              '<form action="{{ url(\'/companynoticeget/\'.'+notice[i].user+') }}" method="post" target="_blank" class="noticeform" enctype="multipart/form-data">'+
                '<input type="hidden" id="userid" value="'+notice[i].user+'">'+
                '<input type="hidden" id="company_id" name="company_id" value="'+notice[i].company_id+'">'+
                '<input type="hidden" id="article_id" name="article_id" value="'+notice[i].article_id+'">'+
                '<input type="hidden" id="towho" name="towho" value="'+notice[i].towho+'">'+
                '<table style="width:90%" border="1px solid black">'+
                  '<tr>'+
                    '<th>'+x+notice[i].name+'</th>'+
                    '<th>'+notice[i].atitle+'</th>'+
                    '<th>'+notice[i].ntitle+'</th>'+
                    '<th>'+notice[i].content+'</th>'+
                    '<th>'+notice[i].created_at+'</th>'+
                    '<th><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="submit" name="submit" value="'+y+'"></th>'+
                  '</tr>'+
                '</table>'+
              '</form>';
              $("#results").append(item);
            }
          }
        })
      });

      $("#forexpire").click(function(e){
        $('#preventshow').empty();
        $('#showtab').empty();
        e.preventDefault();

        $.ajax({
          type: "GET",
          url: "forexpire",
          dataType: 'json',
          success: function(data){
            console.log(data);
            var article = data.article;
            for(var i=0 ; i < article.length ; i++){
              var item =
              '<tr>'+
              '<th><input type="checkbox" name="articleid[]" value="'+article[i].id+'"></th>'+
              '<th><a href="/updatearticle/'+article[i].id+'}}">'+article[i].title+ '</th>'+
              '<th>'+article[i].type+ '</th>'+
              '<th>'+article[i].company+ '</th>'+
              '<th>'+article[i].detail+ '</th>'+
              '<th>'+article[i].deadline+ '</th>'+
              '<th>'+article[i].location+ '</th>'+
              '</tr>';
              $('#showtab').append(item);
            }
            $('#count').empty();
            $('#count').append("實習貼文數 : "+data.count);
          }
        })
      });


       $("#append").click(function(e){
         e.preventDefault();

         $.ajax({
           type:"GET",
           url:"/appendtofile",
           dataType:"json",
           data: {content:$("#content").val()},
           success: function(data){
             console.log(data);
             $("#file").replaceWith('<div id="file">'+data.content+'</div>');
             $('#content').val('');
           }
         })
       });

       $("#report").click(function(e){
         e.preventDefault();
         $("#reportform").toggle();
       });


       $(":radio").change(function(e){
         e.preventDefault();
         $("#showtest").empty();
         var value = $("input[name='reason']:checked").val();
         $("#showtest").append(value);

       });

       $("#reportform").submit(function(e){
         e.preventDefault();
         $("#reportmsg").empty();
         var value = $("input[name='reason']:checked").val();
         $.ajax({
           type:"POST",
           url:"/report",
           data:{
             article_id:$("#re_article_id").val(),
             article_title:$("#re_article_title").val(),
             report_reason: value,
             report_content:$("#re_report_content").val(),
             company_id:$("#re_company_id").val(),
             article_type:$("#re_article_type").val(),
             article_company:$("#re_article_company").val(),
           },
           success: function(data){
             console.log(data);
             if(data.userexist == 1){
               $("#reportform").toggle();
               $("#report").hide();
               $("#reportmsg").append("您 的 檢 舉 已 送 出！");
             }else{
               $("#subreport").replaceWith('<p>若想使用檢舉功能，請先<big><a href="/login">登入</a></big></p>');
             }
           }
         })

       });

       $.ajaxSetup({
            headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });

        $("#re_cancel").click(function(e){
          e.preventDefault();

          $("#reportform").fadeOut(500);
        });

        $("#follow").click(function(e){
          e.preventDefault();

          $.ajax({
            type: "POST",
            url: "/follow",
            data:{
              company_id:$("#company").val(),
              followed:$("#followed").val()
            },
            success: function(data){
              console.log(data);
              if(data.newfollowed==1){
                $("#newfollowed").replaceWith('<span id="newfollowed">取消追蹤</span>');
                $("#followed").val(1);
              }else if (data.newfollowed==2) {
                $("#follow").replaceWith('<p>若想使用追蹤功能，請先<big><a href="/login">登入</a></big></p>');
              }else{
                $("#newfollowed").replaceWith('<span id="newfollowed">追蹤</span>');
                $("#followed").val(0);
              }
            }
          })
        });

        $("#hours").change(function(e){
          e.preventDefault();
          var salt = $("#hours").val();
          var newsalt = salt*176;

          $("#salt").val(newsalt);
        });

        $("#showcompany").hide();

        $("#lovecompany").click(function(e){
          e.preventDefault();
          $("#showcompany").empty();

          $.ajax({
            type: "GET",
            url: "/showfollows",
            success: function(data){
              console.log(data);
              $("#showcompany").append('<small>一週內新實習動態</small><br>');
              var article = data.article;
              var company = data.company;
              if(article.length==0){
                for(var i=0; i<company.length; i++){
                  var item0 =
                  '<span>'+company[i].name+' </span>'
                  ;
                  $("#showcompany").append(item0);
                }
                $("#showcompany").append('沒有新文章');
              }else {
                for(var i=0; i<article.length; i++){
                  var item =
                  '<a href="/detail/'+article[i].id+'">'+article[i].title+'</a>　'+
                  '<a href="/company/'+article[i].user_id+'">'+article[i].company+'</a>　'+
                  '<span>'+article[i].type+'</span><br>'
                  ;
                  $("#showcompany").append(item);
                }
              }

              if($("#cfed").val()==0){
                $("#cf").replaceWith('<span id="cf">收起動態 ◤</span>');
                $("#cfed").val(1);
              }else{
                $("#cf").replaceWith('<span id="cf">顯示追蹤中公司動態('+data.follow.length+') ◢</span>');
                $("#cfed").val(0);
              }
              $("#showcompany").toggle();
            }
          })
        });


        $("#shareurl").click(function(e){
          $("#reportmsg").empty();
          e.preventDefault();
          var url = window.location.href;
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(url).select();
          document.execCommand("copy");
          $temp.remove();
          $("#reportmsg").append("已複製網址！");
        });

        $("#collecte").click(function(e){
          $("#msg").empty();
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "/addtocollection",
            data: $("#detailform").serialize(),
            success:function(data){
              console.log(data);
              if(data.userexist == 0){
                $("#collecte").replaceWith('<p>若想使用收藏功能，請先<big><a href="/login">登入</a></big></p>');
              }else{
                if(data.collecteok == 0){
                  $("#msg").append("此實習貼文已收藏過！");
                }else{
                  $("#msg").append("成功收藏！");
                }
              }
            }
          })
        });

        $("#apply").click(function(e){
          $("#msg").empty();
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "/applythis",
            data: $("#detailform").serialize(),
            success:function(data){
              console.log(data);
              if(data.userexist == 0){
                $("#apply").replaceWith('<p>若想使用應徵功能，請先<big><a href="/login">登入</a></big></p>');
              }else{
                if(data.applyok == 0){
                  $("#msg").append("此實習貼文已應徵過！");
                }else{
                  $("#msg").append("成功應徵！");
                }
              }
            }
          })
        });

        // application start

        $("#jobcity,#jobtype").change(function(e){
          $("#prevent").empty();
          $("#results").empty();
          $("#count").empty();
          e.preventDefault();
          $.ajax({
            type: "GET",
            url: "/applisearch",
            dataType: "json",
            data: {ans:$("#keyword").val(),ans1:$("#jobcity").val(),ans2:$("#jobtype").val()},
            success:function(data){
              console.log(data);
              var A=""; //numofreport
              var article = data.article;
              var reportnum = data.reportnum;
              var count = data.count;
              for (var i = 0; i < article.length; i++) {
                if(article[i].hot==1){
                var A='√';
                }
                else{
                var A='×';
                }
                var item =
                '<tr>'+
                '<td><input type="checkbox" name="articleid[]" value='+article[i].id+'></td>'+
                '<td>'+article[i].type+'</td>'+
                '<td><a href="/detail/'+article[i].id+'">'+article[i].title+'</td>'+
                '<td><a href="/company/'+article[i].user_id+'">'+article[i].company+'</td>'+
                '<td>'+article[i].numofapply+'人</td>'+
                '<td>'+article[i].numoflike+'人</td>'+
                '<td>'+article[i].created_at+'</td>'+
                '<td>'+article[i].deadline+'</td>'+
                '<td><a href="/showreport/'+article[i].id+'">'+reportnum[i]+'</td>'+
                '<td>'+A+'</td>'+
                '</tr>';
                $("#results").append(item);
              }
              $("#count").append('顯示實習數 : '+count);
            }
          })
        });

        $("#findarticle").click(function(e){
          $("#prevent").empty();
          $("#results").empty();
          $("#count").empty();
          e.preventDefault();
          $.ajax({
            type: "GET",
            url: "/applisearch",
            dataType: "json",
            data: {ans:$("#keyword").val(),ans1:$("#jobcity").val(),ans2:$("#jobtype").val()},
            success:function(data){
              console.log(data);
              var A=""; //numofreport
              var article = data.article;
              var reportnum = data.reportnum;
              var count = data.count;
              for (var i = 0; i < article.length; i++) {
                if(article[i].hot==1){
                var A='√';
                }
                else{
                var A='×';
                }
                var item =
                '<tr>'+
                '<td><input type="checkbox" name="articleid[]" value='+article[i].id+'></td>'+
                '<td>'+article[i].type+'</td>'+
                '<td><a href="/detail/'+article[i].id+'">'+article[i].title+'</td>'+
                '<td><a href="/company/'+article[i].user_id+'">'+article[i].company+'</td>'+
                '<td>'+article[i].numofapply+'人</td>'+
                '<td>'+article[i].numoflike+'人</td>'+
                '<td>'+article[i].created_at+'</td>'+
                '<td>'+article[i].deadline+'</td>'+
                '<td><a href="/showreport/'+article[i].id+'">'+reportnum[i]+'</td>'+
                '<td>'+A+'</td>'+
                '</tr>';
                $("#results").append(item);
              }
              $("#count").append('顯示實習數 : '+count);
            }
          })
        });

        $("#fincompany").click(function(e){
          $("#prevent").empty();
          $("#results").empty();
          $("#count").empty();
          e.preventDefault();
          $.ajax({
            type: "GET",
            url: "/applisearch2",
            dataType: "json",
            data: {ans:$("#keyword").val(),ans1:$("#jobcity").val(),ans2:$("#jobtype").val()},
            success:function(data){
              console.log(data);
              var A=""; //numofreport
              var article = data.article;
              var reportnum = data.reportnum;
              var count = data.count;
              for (var i = 0; i < article.length; i++) {
                if(article[i].hot==1){
                var A='√';
                }
                else{
                var A='×';
                }
                var item =
                '<tr>'+
                '<td><input type="checkbox" name="articleid[]" value='+article[i].id+'></td>'+
                '<td>'+article[i].type+'</td>'+
                '<td><a href="/detail/'+article[i].id+'">'+article[i].title+'</td>'+
                '<td><a href="/company/'+article[i].user_id+'">'+article[i].company+'</td>'+
                '<td>'+article[i].numofapply+'人</td>'+
                '<td>'+article[i].numoflike+'人</td>'+
                '<td>'+article[i].created_at+'</td>'+
                '<td>'+article[i].deadline+'</td>'+
                '<td><a href="/showreport/'+article[i].id+'">'+reportnum[i]+'</td>'+
                '<td>'+A+'</td>'+
                '</tr>';
                $("#results").append(item);
              }
              $("#count").append('顯示實習數 : '+count);
            }
          })
        });

        $("#top").click(function(e){
          e.preventDefault();
          var article_id = [];
            $.each($("input[name='articleid[]']:checked"), function(){
                article_id.push($(this).val());
            });
          if(article_id.length == 0){
            article_id.push(null);
          }
          $("#prevent").empty();
          $("#results").empty();
          $("#count").empty();
          $.ajax({
            type: "POST",
            url: "/top",
            data: {ans:article_id},
            success:function(data){
              console.log(data);
              var A=""; //numofreport
              var article = data.article;
              var reportnum = data.reportnum;
              var count = data.count;
              for (var i = 0; i < article.length; i++) {
                if(article[i].hot==1){
                var A='√';
                }
                else{
                var A='×';
                }
                var item =
                '<tr>'+
                '<td><input type="checkbox" name="articleid[]" value='+article[i].id+'></td>'+
                '<td>'+article[i].type+'</td>'+
                '<td><a href="/detail/'+article[i].id+'">'+article[i].title+'</td>'+
                '<td><a href="/company/'+article[i].user_id+'">'+article[i].company+'</td>'+
                '<td>'+article[i].numofapply+'人</td>'+
                '<td>'+article[i].numoflike+'人</td>'+
                '<td>'+article[i].created_at+'</td>'+
                '<td>'+article[i].deadline+'</td>'+
                '<td><a href="/showreport/'+article[i].id+'">'+reportnum[i]+'</td>'+
                '<td>'+A+'</td>'+
                '</tr>';
                $("#results").append(item);
              }
              $("#count").append('顯示實習數 : '+count);
            }
          })
        });

        $("#notop").click(function(e){
          e.preventDefault();
          var article_id = [];
            $.each($("input[name='articleid[]']:checked"), function(){
                article_id.push($(this).val());
            });
          if(article_id.length == 0){
            article_id.push(null);
          }
          $("#prevent").empty();
          $("#results").empty();
          $("#count").empty();
          $.ajax({
            type: "POST",
            url: "/notop",
            data: {ans:article_id},
            success:function(data){
              console.log(data);
              var A=""; //numofreport
              var article = data.article;
              var reportnum = data.reportnum;
              var count = data.count;
              for (var i = 0; i < article.length; i++) {
                if(article[i].hot==1){
                var A='√';
                }
                else{
                var A='×';
                }
                var item =
                '<tr>'+
                '<td><input type="checkbox" name="articleid[]" value='+article[i].id+'></td>'+
                '<td>'+article[i].type+'</td>'+
                '<td><a href="/detail/'+article[i].id+'">'+article[i].title+'</td>'+
                '<td><a href="/company/'+article[i].user_id+'">'+article[i].company+'</td>'+
                '<td>'+article[i].numofapply+'人</td>'+
                '<td>'+article[i].numoflike+'人</td>'+
                '<td>'+article[i].created_at+'</td>'+
                '<td>'+article[i].deadline+'</td>'+
                '<td><a href="/showreport/'+article[i].id+'">'+reportnum[i]+'</td>'+
                '<td>'+A+'</td>'+
                '</tr>';
                $("#results").append(item);
              }
              $("#count").append('顯示實習數 : '+count);
            }
          })
        });

        $("#clickAll").click(function() {
          if($("#clickAll").prop("checked")) {
            $("input[name='articleid[]']").each(function() {
              $(this).prop("checked", true);
            });
          } else {
            $("input[name='articleid[]']").each(function() {
              $(this).prop("checked", false);
            });
          }
        });


        // application end

        $("#typeshow3,#cityshow3").change(function(e){
          $('#preventshow3').empty();
          $('#showtab3').empty();
          e.preventDefault();
          $.ajax({
            type: "GET",
            url: "/searchselect3",
            dataType: "json",
            data: {ans1:$("#cityshow3").val(),ans2:$("#typeshow3").val(),ans3:$("#company").val()},
            success: function(data){
              console.log(data);
              var article = data.article;
              for(var i=0 ; i < article.length ; i++){
                var item =
                '<h2>'+article[i].title+'　<sub>　by '+'<a href="/company/'+article[i].user_id+'">'+article[i].company+'</a></sub></h2>'+
                '<p><var>'+article[i].type+ '</var></p>'+
                '<p>位於'+article[i].location+ '</p>'+
                '<p>待遇$'+article[i].salt+'</p>'+
                '<p>需求人數'+article[i].numofpeople+ '</p>'+
                '<p>'+article[i].content+ '</p>'+
                '<a href="/detail/'+article[i].id+'">More..</a>'+
                '<p align="right">發布於'+article[i].created_at +' '+article[i].numofapply +'人應徵 '+article[i].numoflike +'人收藏</p>'+
                '<hr>';
                $('#showtab3').append(item);
            }
          }
         })

        });

        $("#talks").click(function(e){
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "/addtalks",
            data:$("#talksform").serialize(),
            success: function(data){
              console.log(data);
              var notice = data.notice;
              var item =
              '<span><b>你的新訊息</b></span><br>'+
              '<span><small><sub>'+notice.created_at+'</small></sub></span>  '+
              '<span><sub>已傳送</sub></span>  '+
              '<span>'+notice.content+'</span>';
              $("#newtalk").append(item);
              $("#content").val('');
            }
          })
        });

        // -------------------- 0922 --------------------
        // usersboard start

        $("a#setadmin").click(function(e){
          e.preventDefault();
          $("#user_name").empty();
          $("#setadminbox").show();
          var user_id = $(this).attr('href').split('/')[2];
          var user_name = $(this).attr('href').split('/')[1];
          var user_admin = $(this).attr('href').split('/')[0];
          $("#user_id").val(user_id);
          $("#user_name").append(user_name + " 權限 : ");
          $("#username").val(user_name);

          if(user_admin==2){
            $(":radio").prop("checked", false);
            $("#admin_2").prop("checked", true);
          }else if(user_admin==1){
            $(":radio").prop("checked", false);
            $("#admin_1").prop("checked", true);
          }else{
            $(":radio").prop("checked", false);
            $("#admin_0").prop("checked", true);
          }
        });

        $("#ad_cancel").click(function(e){
          e.preventDefault();

          $("#setadminbox").fadeOut(500);
        });

        // $("#ad_submit").click(function(e){
        //   $("#adminmsg").empty();
        //   e.preventDefault();
        //   $.ajax({
        //     type:"POST",
        //     url:"/adminupdate",
        //     data:$("#setadminbox").serialize(),
        //     success: function(data){
        //       $("#setadminbox").hide();
        //       $("#adminmsg").append("更新完成，請刷新頁面");
        //     }
        //   })
        // });

        // usersboard end

        //

        // 1001 fullsearch start

        $("#searchall").click(function(e){
          $('#e04').empty();
          $('#e111').empty();
          $('#futura').empty();
          e.preventDefault();
          $.ajax({
            type: "GET",
            url:"/searchAll",
            data:{key:$("#key").val()},
            success: function(data){
              console.log(data);
              if(data.job104.length==0){
                var item104 = '我找不到<b>"'+$("#key").val()+'"</b>相關實習哭哭　';
                $('#e04').append(item104);
              }else{
                for(var i=0 ; i < data.job104.length ; i++){
                  var item104 =
                  '<p>'+
                    '<a href="https://www.104.com.tw'+data.job104[i].url+'">'+data.job104[i].title+'</a>'+
                    '<span>　'+data.company104[i].title+'</span>'+
                    '<span>　'+data.loca104[i].loca+'</span>'+
                  '</p>';
                  $('#e04').append(item104);
                }
              }
              $('#e04').append('<a href="'+data.url104+'">＞ > <small>></small> 到 104 看更多．．．</a>');

              if(data.job1111.length==0){
                var item1111 = '我找不到<b>"'+$("#key").val()+'"</b>相關實習哭哭　';
                $('#e111').append(item1111);
              }else{
                for(var i=0 ; i < data.job1111.length ; i++){
                  if(i>10){i=20}
                  var item1111 =
                  '<p>'+
                    '<a href="https://www.1111.com.tw'+data.job1111[i].url+'">'+data.job1111[i].title+'</a>'+
                    '<span>　'+data.job1111[i].company+'</span>'+
                    '<span>　'+data.loca1111[i].loca+'</span>'+
                  '</p>';
                  $('#e111').append(item1111);
                }
              }
              $('#e111').append('<a href="'+data.url1111+'">＞ > <small>></small> 到 1111 看更多．．．</a>');

              if(data.article.length==0){
                var item = '我找不到<b>"'+$("#key").val()+'"</b>相關實習哭哭　';
                $('#futura').append(item);
              }else{
                for(var i=0 ; i < data.article.length ; i++){
                  if(i>10){i=21}
                  var item =
                  '<p>'+
                    '<a href="/detail/'+data.article[i].id+'">'+data.article[i].title+'</a>'+' by '+
                    '<a href="/company/'+data.article[i].user_id+'">'+data.article[i].company+'</a>'+
                    '<span>　'+data.article[i].location+'</span>'+
                  '</p>';
                  $('#futura').append(item);
                }
              }
            }
          })
        });


        // fullsearch end



        //練習程檢 0825 *************************************************

        $("#q1").click(function(e){
          e.preventDefault();
          $("#ans1").empty();
          var x = $("#q1val").val();
          if(x%2==0 || x%3==0){
            $("#ans1").append("Ture");
          }else{
            $("#ans1").append("false");
          }
        });

        $("#q2").click(function(e){
          e.preventDefault();
          $("#ans2").empty();
          var x = $("#q2val").val();
          $("#ans2").append(x.replace(/[^A-Z]/gi, "").length);
        });

        $("#q3").click(function(e){
          e.preventDefault();
          $("#ans3").empty();
          var x = $("#q3val").val();
          var number = [2];
          var a=0;
          var y;

          if(x<4 || x>10000 || x%2==1){
            $("#ans3").append("請輸入4~10000之間的偶數");
          }else{
            for(i=3;i<10000;i++){
              for(j=2;j<i;j++){
                if(i%j==0){
                  a=a+1;
                }else{
                  a=a+0;
                }
              }
              if(a==0){
                number.push(i);
              }
              a=0;
            }

            for (var k = 0; k < number.length; k++) {
              for (var l = 0; l < number.length; l++) {
                if(number[k]+number[l]==x){
                  y = number[k];
                  z = number[l];
                  break;
                }

              }
            }

            $("#ans3").append(z+' '+y);
          }
        });

        $("#q4").click(function(e){
          e.preventDefault();
          $("#ans4").empty();
          var y = $("#q4valy").val();
          var m = $("#q4valm").val();
          if(m==1||m==3||m==5||m==7||m==8||m==10||m==12){
            $("#ans4").append("31");
          }else if (m==4||m==6||m==9||m==11) {
            $("#ans4").append("30");
          }else if(m==2){
            if(y%400==0){
              $("#ans4").append("29");
            }else if(y%100==0){
              $("#ans4").append("28");
            }else if(y%4==0){
              $("#ans4").append("29");
            }else{
              $("#ans4").append("28");
            }
          }else{
            $("#ans4").append("月份不正確");
          }
        });

        $("#q5").click(function(e){
          e.preventDefault();
          $("#ans5").empty();
          var y = $("#q5valy").val();
          var m = $("#q5valm").val();
          var d = $("#q5vald").val();
          var a = 0;
          if(m==1||m==3||m==5||m==7||m==8||m==10||m==12){
            if(d>31){
              $("#ans5").append("日期錯誤");
              a+=1;
            }
          }else if (m==4||m==6||m==9||m==11) {
            if(d>30){
              $("#ans5").append("日期錯誤");
              a+=1;
            }
          }else if(m==2){
            if(y%400==0){
              if(d>29){
                $("#ans5").append("日期錯誤");
                a+=1;
              }
            }else if(y%100==0){
              if(d>28){
                $("#ans5").append("日期錯誤");
                a+=1;
              }
            }else if(y%5==0){
              if(d>29){
                $("#ans5").append("日期錯誤");
                a+=1;
              }
            }else{
              if(d>28){
                $("#ans5").append("日期錯誤");
                a+=1;
              }
            }
          }else{
            $("#ans5").append("日期錯誤");
            a+=1;
          }
          if(a==0){
            $("#ans5").append(y+'/'+m+'/'+d);
          }
        });

        $("#q6").click(function(e){
          e.preventDefault();
          $("#ans6").empty();
          var x = $("#q6val").val();
          var y = x.split(',');
          var a = 0;
          for (var i = 1; i < y.length-1; i++) {
            if(y[i]-y[i-1]==y[i+1]-y[i]){
              a+=0;
            }else{
              a+=1;
            }
          }
          if(a==0){
            $("#ans6").append("YES");
          }else{
            $("#ans6").append("NO");
          }
        });




});
