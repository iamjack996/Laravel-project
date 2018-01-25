<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>程式檢定練習</title>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
  </head>
  <body>

    <form>
      <p>1.判斷輸入數值是否為2或3的倍數 : </p>
      <input type="text" id="q1val" name="" value="">
      <button type="button" id="q1">檢查</button>
      <div>
        回傳結果 : <div id="ans1"></div>
      </div>

      <p>2.輸入英文字串計算字串長度 : </p>
      <input type="text" id="q2val" name="" value="">
      <button type="button" id="q2">檢查</button>
      <div>
        字串長度 : <div id="ans2"></div>
      </div>

      <p>3.輸入4~10000間任意偶數n，將n拆成兩質數的和。 </p>
      <input type="text" id="q3val" name="" value="">
      <button type="button" id="q3">拆解</button>
      <div>
        兩質數 : <div id="ans3"></div>
      </div>

      <p>4.輸入(西元)年月份，顯示該月天數 :</p>
      <input type="text" id="q4valy" name="" value="">年
      <input type="text" id="q4valm" name="" value="">月
      <button type="button" id="q4">檢查</button>
      <div>
        天數 : <div id="ans4"></div>
      </div>

      <p>5.輸入(西元)年月日，檢查是否為合法日期，顯示(yyyy/mm/dd) :</p>
      <input type="text" id="q5valy" name="" value="">年
      <input type="text" id="q5valm" name="" value="">月
      <input type="text" id="q5vald" name="" value="">日
      <button type="button" id="q5">檢查</button>
      <div>
        顯示 : <div id="ans5"></div>
      </div>

      <p>6.輸入一串數字(以 , 為區隔)，判斷是否為等差數列 :</p>
      <input type="text" id="q6val" name="" value="">
      <button type="button" id="q6">檢查</button>
      <div>
        回傳結果 : <div id="ans6"></div>
      </div>



    </form>





  <script type="text/javascript" src = "js/app.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
