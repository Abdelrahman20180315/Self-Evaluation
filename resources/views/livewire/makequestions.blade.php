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
      


        <form >
              
               <div class="row">
                    
                    <div style="text-align:right" class="col-md-12 mb-3">
                    <label>نص السؤال</label>
                        <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="question_text.0" required/>
                        @error('question_text.0')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>  
                    
                      
                    <div style="text-align:right" class="col-md-12 mb-3">
                    <label>وزن السؤال</label>
                        <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="question_score.0" required/>
                        @error('question_score.0')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3" >
                        <select class="form-select"  wire:model="question_resultstatus.0" aria-label="Default select example" style="text-align: right" required>
                          <option value="">اختر نوع الاجابة</option>
                          
                            <option value="1">نعم أو لا</option>
                            <option value="2">رقم</option>
                            <option value="3">نص محدد</option>
                            {{-- <option value="4">وثيقة</option> --}}

                        </select>
                        @error('question_resultstatus.0')
                          <div class="alert alert-danger">
                              {{$message}}
                          </div>
                        @enderror
                      </div>
                      <div class="col-md-12 mb-3" >
                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$group_id}}"  wire:model="group_id.0" hidden/>
                    </div>
                    
                    <div style="text-align:right;" class="col-md-12 mb-3">
                        <button class="btn btn-primary mb-3" wire:click.prevent="add({{$i}})">إضافة سؤال اخر</button>      
                        {{-- <input value="اضافه" style="background-color: crimson" type="submit" class="btn btn-primary"  name="image" /> --}}
                    </div>
                    {{-- Add Form --}}
                    @foreach ($inputs as $key => $value)
                       <div style="text-align:right" class="col-md-12 mb-3">
                        <label>نص السؤال</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="question_text.{{ $value }}" required/>
                            @error('question_text.')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>  
                        
                          
                        <div style="text-align:right" class="col-md-12 mb-3">
                        <label>وزن السؤال</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="question_score.{{ $value }}" required/>
                            @error('question_score.')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3" >
                            <select class="form-select"  wire:model="question_resultstatus.{{ $value }}" aria-label="Default select example" style="text-align: right" required>
                              <option value="">اختر نوع الاجابة</option>
                              
                                <option value="1">نعم أو لا</option>
                                <option value="2">رقم</option>
                                <option value="3">نص محدد</option>
                                {{-- <option value="4">وثيقة</option> --}}
    
                            </select>
                            @error('question_resultstatus.')
                              <div class="alert alert-danger">
                                  {{$message}}
                              </div>
                            @enderror
                          </div>
                          {{-- <div class="col-md-12 mb-3" >
                            <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$group_id}}"  wire:model="group_id.{{ $value }}" hidden/>
                          </div> --}}
                        
                        <div style="text-align:right;" class="col-md-12 mb-3">

                            <button class="btn btn-light mb-3" wire:click.prevent="remove({{$key}})"><i class="bi bi-x"></i></button>
                        
                            {{-- <button class="btn btn-primary mb-3" wire:click.prevent="add({{$i}})"><i class="bi bi-plus"></i></button>       --}}
                            {{-- <input value="اضافه" style="background-color: crimson" type="submit" class="btn btn-primary"  name="image" /> --}}
                        </div>
                    @endforeach 
                    <div class="row">
                        <div class="col-12 ps-0">
                             <button type="button" class="btn btn-primary" style="background-color: red" wire:click.prevent="store()">Save</button>
                        </div>
                    </div>         
                </div>
        </form> 
</div>    

{{-- <div class="card-body" >
</div>     --}}
<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            
            <h6 class="text-white text-capitalize ps-3">جدول الاسئلة</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          @if(Session()->has('deletedquestion'))
            <div class="div alert alert-danger">
              {{Session('deletedquestion')}}
            </div>
          @endif
          <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نص السؤال</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">وزن السؤال</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">نوع الاجابة</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اكشن 1</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اكشن 2</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($questions as $question)
                <tr>
                  
                  <td>
                    <span class="text-xs font-weight-bold"><a href="{{url('/createresults/selectedquestion',$question->id)}}">{{$question->question_text}}</a></span>
                  </td>
                  <td>
                    <span class="text-xs font-weight-bold">{{$question->question_score}}</span>
                  </td>
                  <td>
                    @if($question->question_resultstatus == '1')
                        <span class="text-xs font-weight-bold">نعم او لا</span>
                    @elseif($question->question_resultstatus == '2')
                        <span class="text-xs font-weight-bold">رقم</span>
                    @elseif($question->question_resultstatus == '3')
                        <span class="text-xs font-weight-bold">نص محدد</span>
                    @else
                        <span class="text-xs font-weight-bold">وثيقة</span>    
                    @endif
                  </td>
                  <td>
                    <a href="{{url('/editquestion', $question->id)}}" class="btn btn-success">Edit</a>
                  </td>
                  <td>
                    <a href="{{url('/deletequestion', $question->id)}}" class="btn btn-danger">Delete</a>
                  </td>
                  
                </tr>
                @endforeach
            
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
</div>  








