<?php
   // header('Content-Type: application/json');
   include_once 'functions.php';
   include_once 'debug.php'; // for forelink test
   // $ php show_userranking.php type # type = day/retest/all
   // https://solution.forelink-cloud.co.kr/moodle3/kukp/show_userranking.php?type=all

   if (isset($_GET["type"])) {
      $type = $_GET["type"];
      $isprint = false;
      $db = new Functions();
      $data = $db->getAllUsersQuizInfo($type, '', '', 'last', false);
      $userdata = $data[1]; $userdata_count = sizeof($userdata);
      sort($userdata);

      $outtype = "succ"; // or "fail"
      $sentence_lmt1 = 12;
      $sentence_lmt2 = 3;
      $rankdata_count = 0;
      $rankdata = array();
      if ($isprint) {
         printf("%-8s %3s %3s %3s %3s   %3s/%3s  %7s  %8s (%s)\n", "NAME",
         "T1", "T2", "T3", "T4", "ALL", "QUZ", "", "ELAPSE_TIME", $outtype);
      }
      for ($i = 0; $i < 2; $i++) {
         for ($j = 0; $j < $userdata_count; $j++) {
            $isover1 = ($userdata[$j][sentence_count]>=$sentence_lmt1);
            $isover2 = ($userdata[$j][sentence_count]<$sentence_lmt1)&&($userdata[$j][sentence_count]>=$sentence_lmt2);
            if (($i == 0 && $isover1) || ($i == 1 && $isover2)) {
               $n = $rankdata_count++;
               $rankdata[$n] = $db->calcUserQuizInfo($userdata[$j], $outtype);
               $rankdata[$n][user_id] = $userdata[$j][user_id];
               $rankdata[$n][elapse_time] = $userdata[$j][elapse_time] / 1000;
               if ($isprint) {
                  printf("%-8s %3d %3d %3d %3d   %3d/%3d  (%3.1f%%)  %8.3fs\n", $rankdata[$n][user_id],
                  $rankdata[$n][t1_n], $rankdata[$n][t2_n],   $rankdata[$n][t3_n],   $rankdata[$n][t4_n],
                  $rankdata[$n][alln], $rankdata[$n][alltot], $rankdata[$n][allrat], $rankdata[$n][elapse_time]);
               }
            }
         }
      }
      // $all_table = json_encode($table_array);
      if ($rankdata_count <= 0) {
         print("None of data\n");
      }
      $picture1 = "unity1.0/media/COMMON/score_list_good.gif";
      $picture2 = "unity1.0/media/COMMON/score_list_continue.gif";
   }
?>

<!DOCTYPE html>
<html>
  <head>
    <style>
            .cssHeaderRow {
                background-color: blue;
            }
            .cssTableRow {
                background-color: #F0F1F2;
            }
            .cssOddTableRow {
                background-color: #F0F1F2;
            }
            .cssSelectedTableRow {
                font-size: 20px;
                font-weight:bold;
            }
            .cssHoverTableRow {
                background: #ccc;
            }
            .cssHeaderCell {
                color: #FFFFFF;
                font-size: 20px;
                padding: 10px !important;
                border: solid 1px #FFFFFF;
            }
            .cssTableCell {
                font-size: 18px;
                text-align: center;
                padding: 10px !important;
                border: solid 1px #FFFFFF;
            }
            .cssRowNumberCell {
                text-align: center;
            }
        </style>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      function drawTable() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', '이름');
        data.addColumn('number', '평균');
        data.addColumn('number', '총 단어수: <?=$rankdata[$n][alltot]?>');
        data.addColumn('number', '의미');
        data.addColumn('number', '듣기');
        data.addColumn('number', '사용');
        data.addColumn('number', '구성');
        data.addColumn('number', '총 소요 시간');
        data.addRows([
          ['<?=($rankdata[0][user_id])?>',  {v: <?=round($rankdata[0][allrat],2)?>, f: '<?=round($rankdata[0][allrat],2)?>%'}, <?=$rankdata[0][alln]?>, {v: <?=($rankdata[0][t1_n])?>, f: '<?=($rankdata[0][t1_n])?>'}, {v: <?=($rankdata[0][t2_n])?>, f: '<?=($rankdata[0][t2_n])?>'},
          {v: <?=($rankdata[0][t3_n])?>, f: '<?=($rankdata[0][t3_n])?>'},{v: <?=($rankdata[0][t4_n])?>, f: '<?=($rankdata[0][t4_n])?>'},{f: '<?=round($rankdata[0][elapse_time],1)?>(s)'}],
          ['<?=($rankdata[1][user_id])?>',  {v: <?=round($rankdata[1][allrat],2)?>, f: '<?=round($rankdata[1][allrat],2)?>%'}, <?=$rankdata[1][alln]?>, {v: <?=($rankdata[1][t1_n])?>, f: '<?=($rankdata[1][t1_n])?>'}, {v: <?=($rankdata[1][t2_n])?>, f: '<?=($rankdata[1][t2_n])?>'},
          {v: <?=($rankdata[1][t3_n])?>, f: '<?=($rankdata[1][t3_n])?>'},{v: <?=($rankdata[1][t4_n])?>, f: '<?=($rankdata[1][t4_n])?>'},{f: '<?=round($rankdata[1][elapse_time],1)?>(s)'}],
          ['<?=($rankdata[2][user_id])?>',  {v: <?=round($rankdata[2][allrat],2)?>, f: '<?=round($rankdata[2][allrat],2)?>%'}, <?=$rankdata[2][alln]?>, {v: <?=($rankdata[2][t1_n])?>, f: '<?=($rankdata[2][t1_n])?>'}, {v: <?=($rankdata[2][t2_n])?>, f: '<?=($rankdata[2][t2_n])?>'},
          {v: <?=($rankdata[2][t3_n])?>, f: '<?=($rankdata[2][t3_n])?>'},{v: <?=($rankdata[2][t4_n])?>, f: '<?=($rankdata[2][t4_n])?>'},{f: '<?=round($rankdata[2][elapse_time],1)?>(s)'}],
          ['<?=($rankdata[3][user_id])?>',  {v: <?=round($rankdata[3][allrat],2)?>, f: '<?=round($rankdata[3][allrat],2)?>%'}, <?=$rankdata[3][alln]?>, {v: <?=($rankdata[3][t1_n])?>, f: '<?=($rankdata[3][t1_n])?>'}, {v: <?=($rankdata[3][t2_n])?>, f: '<?=($rankdata[3][t2_n])?>'},
          {v: <?=($rankdata[3][t3_n])?>, f: '<?=($rankdata[3][t3_n])?>'},{v: <?=($rankdata[3][t4_n])?>, f: '<?=($rankdata[3][t4_n])?>'},{f: '<?=round($rankdata[3][elapse_time],1)?>(s)'}],
          ['<?=($rankdata[4][user_id])?>',  {v: <?=round($rankdata[4][allrat],2)?>, f: '<?=round($rankdata[4][allrat],2)?>%'}, <?=$rankdata[4][alln]?>, {v: <?=($rankdata[4][t1_n])?>, f: '<?=($rankdata[4][t1_n])?>'}, {v: <?=($rankdata[4][t2_n])?>, f: '<?=($rankdata[4][t2_n])?>'},
          {v: <?=($rankdata[4][t3_n])?>, f: '<?=($rankdata[4][t3_n])?>'},{v: <?=($rankdata[4][t4_n])?>, f: '<?=($rankdata[4][t4_n])?>'},{f: '<?=round($rankdata[4][elapse_time],1)?>(s)'}],
        ]);


        var table = new google.visualization.Table(document.getElementById('barformat_div'));

        var formatter = new google.visualization.BarFormat({width: 120, showValue: true, max: <?=$rankdata[$n][alltot]?>});
        formatter.format(data, 2); // Apply formatter to second column

        var cssClassNames = {
                    'headerRow': 'cssHeaderRow',
                    'tableRow': 'cssTableRow',
                    'oddTableRow': 'cssOddTableRow',
                    'selectedTableRow': 'cssSelectedTableRow',
                    'hoverTableRow': 'cssHoverTableRow',
                    'headerCell': 'cssHeaderCell',
                    'tableCell': 'cssTableCell',
                    'rowNumberCell': 'cssRowNumberCell'
                };

        table.draw(data, {
          allowHtml: true,
          showRowNumber: true,
          width: '100%',
          height: '100%',
          cssClassNames: cssClassNames
        });


      }
    </script>
  </head>
  <body>
      <div id="barformat_div" style="border: 1px solid grey"></div>

      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <img src="<?=$picture2?>" style="margin-left: auto; margin-right: auto; display: block;"/>
          </div>
        </div>
      </div>

  </body>
</html>
