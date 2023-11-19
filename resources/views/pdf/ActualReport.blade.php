<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>صفحة التقارير</title>
    <style>
        #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        }
        #leftbox {
                float:left;
                 /* background:Red; */
                width:25%;
                /* height:280px; */ 
            }
        
            #rightbox{
                float:right;
                /* background:blue; */
                width:25%;
                /* height:280px; */
            }

    </style>
</head>
<body>
    <p style="text-align: center;font-size: 23px" >تقرير</p>

    
        {{-- <h4>رقم المستخدم </h4>  {{$user_id}}  --}}
        <div id="boxes">
            <div id="rightbox" style="text-align: right"><p style="font-size: 20px">اسم المستخدم</p> {{$user_name}} </div>
            <div id="leftbox" style="text-align: right"><p style="font-size: 20px">نوع التقييم</p> {{$evaluate_name}}</div>
        </div>
        <div id="boxes">
            <div id="rightbox" style="text-align: right"><p style="font-size: 20px">اسم البرنامج</p> {{$program_name}} </div>
            <div id="leftbox" style="text-align: right"><p style="font-size: 20px">نتيجة التقييم الكلي</p> {{$total_score}}</div>
        </div>
        
    
    <br>
        
            <table id="customers">
                <tr>
                <th>evaluate_text</th> 
                <th>evaluate_num</th>
                <th>result</th>
                <th style="text-align: right">question</th>
  
                @foreach($evaluations as $evaluation)
                    <tr>
                    <td style="text-align: right">{{$evaluation->evalute_text}}</td>
                    <td style="text-align: right">{{$evaluation->evalute_num}}</td>  
                    <td style="text-align: right">{{$evaluation->result_value}}</td>
                    <td style="text-align: right">{{$evaluation->question->question_text}}</td>
                    </tr>
                @endforeach
              </table>
              
        
    
</body>
</html>