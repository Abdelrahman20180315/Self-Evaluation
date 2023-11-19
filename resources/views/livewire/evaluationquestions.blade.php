<div>
    <div class="card-body" >
    
    
        @if(Session()->has('message'))
          <div class="div alert alert-success">
            {{Session('message')}}
          </div>
          @endif
    
          @if(Session()->has('failure'))
          <div class="alert alert-danger">
            {{Session('failure')}}
          </div>
          @endif
          
    
    
       

          @if($evaluatetype == 1) 
           

                       
                        
                            @foreach($questions as $question)
                                    @if($question->question_resultstatus == 1)
                                    <form >
                                    <div class="row">
                                        
                                        <div style="text-align:right" class="col-md-12 mb-3">
                                            <label>{{$question->question_text}}</label>
                                            <input type="hidden"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$question->id}}"  wire:model="question_id_yesno" />
                                            {{-- <select  wire:model="result_value[]">
                                                <option value="">اختر نعم او لا</option>
                                                <option value=""><button wire:click.prevent="returnyes()">نعم</button></option>
                                                <option value=""><button wire:click.prevent="returnno()">لا</button></option>
                                            </select> --}}
                                            <button wire:click.prevent="returnyes()">نعم</button>
                                            @error('result_value.')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>  
                
                                        <div style="text-align:right" class="col-md-12 mb-3">
                                                <label>تقييم رقمي للإجابة</label>
                                                <input type="text" style="background-color:OldLace;text-align:right" class="form-control" value="{{$evaluate_num_yesno}}"  wire:model="evaluate_num_yesno"  required/>
                                                @error('evalute_num.')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>  
                
                                            
                                        
                                        <div style="text-align:right" class="col-md-12 mb-3">
                                        <label>تقييم نصي للإجابة</label>
                                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="evaluate_text[]" value="{{$evaluate_text_yesno}}" required/>
                                            @error('evalute_text.0')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        
                                        
                                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$user_id}}"  wire:model="user_id.0" hidden/>
                                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$evaluatetype}}"  wire:model="user_id.0" hidden/>
                                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$programtype}}"  wire:model="user_id.0" hidden/>


                                        
                                        
                                        
                                        <div class="row">
                                            <div class="col-12 ps-0">
                                                <button type="button" class="btn btn-primary" style="background-color: red" wire:click.prevent="store()">Save</button>
                                            </div>
                                        </div>         
                                    </div>
                                </form>    

                                        @endif
                                    @endforeach


                         

        @endif

            
         
     
        
    </div>    
    
    {{-- <div class="card-body" >
    </div>     --}}
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                
                <h6 class="text-white text-capitalize ps-3">جدول الإجابات</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              @if(Session()->has('deleteresult'))
                <div class="div alert alert-danger">
                  {{Session('deleteresult')}}
                </div>
              @endif
              {{-- <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاجابة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">القيمة العليا</th>                          
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تقييم رقمي للإجابة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تقييم نصي للإجابة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اكشن 1</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اكشن 2</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($results as $result)
                    <tr>
                      
                      <td>
                        @if($result->result_status == 1)
                        <span class="text-xs font-weight-bold">{{$result->result_value}}</span>
                        @elseif($result->result_status == 2)
                        <span class="text-xs font-weight-bold">{{$result->min_value}}</span>
                        @else
                        <span class="text-xs font-weight-bold">{{$result->result_value}}</span>
                        @endif
                      </td>

                      <td>
                        @if($result->result_status == 2)
                        <span class="text-xs font-weight-bold">{{$result->max_value}}</span>                     
                        @else
                        <span class="text-xs font-weight-bold"> </span>
                        @endif
                      </td>

                      <td>
                        <span class="text-xs font-weight-bold">{{$result->result_numrate}}</span>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">{{$result->result_textrate}}</span>
                      </td>
                      
                      <td>
                        <a href="{{url('/editresult', $result->id)}}" class="btn btn-success">Edit</a>
                      </td>
                      <td>
                        <a href="{{url('/deleteresult', $result->id)}}" class="btn btn-danger">Delete</a>
                      </td>
                      
                    </tr>
                    @endforeach
                
                    
                  </tbody>
                </table>
              </div> --}}
            </div>
          </div>
        </div>
    </div>
</div>  
