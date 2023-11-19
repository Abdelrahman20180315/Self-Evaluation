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
          
    
    
       

          @if($question_status == 1)  
          <form >
                
                 <div class="row">
                      
                      <div style="text-align:right" class="col-md-12 mb-3">
                      <label>الإجابة(نعم او لا)</label>
                          <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="result_value.0" required/>
                          @error('result_value.0')
                          <div class="alert alert-danger">
                              {{$message}}
                          </div>
                          @enderror
                      </div>  

                      <div style="text-align:right" class="col-md-12 mb-3">
                          <label>تقييم رقمي للإجابة</label>
                              <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="result_numrate.0" required/>
                              @error('result_numrate.0')
                              <div class="alert alert-danger">
                                  {{$message}}
                              </div>
                              @enderror
                          </div>  

                          
                        
                      <div style="text-align:right" class="col-md-12 mb-3">
                      <label>تقييم نصي للإجابة</label>
                          <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="result_textrate.0" required/>
                          @error('result_textrate.0')
                              <div class="alert alert-danger">
                                  {{$message}}
                              </div>
                          @enderror
                      </div>

                    
                     <br>
                        <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                            <label>هل تريد اظهار نص الوثيقة لليوزر حتي يرفق الوثيقة المناسبة؟</label>
                            <br>
                                <label>نعم</label>
                                <input type="radio" value="1" onclick="openDivfirst()" wire:model="pdf_text_status.0"/>
                                
                                <br>
                                <label>لا</label>
                                <input type="radio" value="0"  onclick="closeDivfirst()" wire:model="pdf_text_status.0"/>
                                
                                {{-- @error('pdf_text_status.0')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror --}}
                        </div>
                        {{-- @if($showDiv) --}}
                            <div style="text-align:right;display:none"  class="col-md-12 mb-3" id="showdivfirst" wire:ignore>
                                <label >النص الذي يظهر لإدخال الوثيقة من اليوزر</label>
                                    <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="pdf_text.0" required/>
                                    @error('pdf_text.0')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                            </div>
                            {{-- <div  wire:ignore>
                                <input type="text" id="pdfstatusyesinput"  wire:model="pdf_status_yes.0" >
                                <input type="text" id="pdfstatusnoinput"  wire:model="pdf_status_no.0" >
                            </div>     --}}
                        {{-- @endif --}}

                        <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                            {{-- <label>تقييم نصي للإجابة</label>
                                <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="result_textrate.0" required/> --}}
                                {{-- @error('result_textrate.0')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror --}}
                                <label>قم بإيقاف اسئلة هذه المجموعة وانتقل الي المجموعة التي تليها</label>
                                <input type="checkbox"  onclick="groupstatusfirst()" />
    
                                <br>
                                <label>قم بإيقاف التقييم</label>
                                <input type="checkbox"  onclick="evaluationstatusfirst()" />
    
                                
                        </div>
                        <div style="display: none" wire:ignore>
                            <input type="text" id="groupstatusinput"  wire:model="group_status.0" >
                            <input type="text" id="evaluationstatusinput"  wire:model="evaluation_status.0" >
                        </div>
                            {{-- <input type="text"  value="0" id="groupstatusinput" wire:model="group_status.0" >
                            <input type="text"  value="0" id="evaluationstatusinput" wire:model="evaluation_status.0"> --}}

                         {{--
                    }
        function groupstatusfirst(){
            var groupstatusinput  = document.getElementById('groupstatusinput');
            groupstatusinput.value = 1;
        }
        function evaluationstatusfirst(){
            var evaluationstatusinput  = document.getElementById('evaluationstatusinput');
            evaluationstatusinput.value = 1;
                    --}} 
                        {{-- <input type="checkbox" wire:model="ShowEmail">
                        Show_Email : {{var_export($ShowEmail)}} --}}
                        {{-- <div style="text-align:right" class="col-md-12 mb-3" >
                           
                                <label>قم بإيقاف اسئلة هذه المجموعة وانتقل الي المجموعة التي تليها</label>
                                <input type="checkbox"    onchange="groupstatusfirst()"/>
    
                                <br>
                                <label>قم بإيقاف التقييم</label>
                                <input type="checkbox"   onchange="evaluationstatusfirst()"/>
                                <br>
                                
                    </div> --}}
                    {{-- <input type="hidden" value="0" id="groupstatusinput" wire:model="group_status.0">
                    <input type="hidden" value="0" id="evaluationstatusinput" wire:model="evaluation_status.0"> --}}

                        
                      <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$question_id}}"  wire:model="question_id.0" hidden/>
                      <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$question_status}}"  wire:model="result_status.0" hidden/>
                      
                      
                      <div style="text-align:right;" class="col-md-12 mb-3">
                          <button class="btn btn-primary mb-3" wire:click.prevent="add({{$i}})">إضافة اجابة اخري</button>      
                          {{-- <input value="اضافه" style="background-color: crimson" type="submit" class="btn btn-primary"  name="image" /> --}}
                      </div>
                      {{-- Add Form --}}
                      @foreach ($inputs as $key => $value)
                       
                         <div style="text-align:right" class="col-md-12 mb-3">
                          <label>الإجابة(نعم او لا)</label>
                              <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="result_value.{{ $value }}" required/>
                              @error('result_value.')
                              <div class="alert alert-danger">
                                  {{$message}}
                              </div>
                              @enderror
                          </div>  

                          <div style="text-align:right" class="col-md-12 mb-3">
                              <label>تقييم رقمي للإجابة</label>
                                  <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="result_numrate.{{ $value }}" required/>
                                  @error('result_numrate.')
                                  <div class="alert alert-danger">
                                      {{$message}}
                                  </div>
                                  @enderror
                              </div>  

                              
                            
                          <div style="text-align:right" class="col-md-12 mb-3">
                          <label>تقييم نصي للإجابة</label>
                              <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="result_textrate.{{ $value }}" required/>
                              @error('result_textrate.')
                                  <div class="alert alert-danger">
                                      {{$message}}
                                  </div>
                              @enderror
                          </div>
                            
                            <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                                <label>هل تريد اظهار نص الوثيقة لليوزر حتي يرفق الوثيقة المناسبة؟</label>
                                <br>
                                    <label>نعم</label>
                                    <input type="radio" style="text-align:right" value="1"  onclick="opendivdy({{ $value }})" wire:model="pdf_text_status.{{ $value }}"/>
                                    
                                    <br>
                                    <label>لا</label>
                                    <input type="radio" style="text-align:right" value="0"  onclick="closedivdy({{ $value }})" wire:model="pdf_text_status.{{ $value }}"/>
                                    
                                    @error('pdf_text_status.')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                            </div>
                            
                            <div style="text-align:right;display:none" class="col-md-12 mb-3" id="showDivdynamic_{{ $value }}" wire:ignore >
                                <label >النص الذي يظهر لإدخال الوثيقة من اليوزر</label>
                                    <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="pdf_text.{{ $value }}" required/>
                                    @error('pdf_text.')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                            </div>
                            
                            {{-- <div  wire:ignore>
                                <input type="text" id="pdfstatusyesdynamic_{{ $value }}"  wire:model="pdf_status_yes.{{ $value }}" >
                                <input type="text" id="pdfstatusnodynamic_{{ $value }}"  wire:model="pdf_status_no.{{ $value }}" >
                            </div>   --}}
                          
                            <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                                
                                    <label>قم بإيقاف اسئلة هذه المجموعة وانتقل الي المجموعة التي تليها</label>
                                    <input type="checkbox" style="text-align:right"  onchange="groupstatusdynamic({{ $value }})" />
        
                                    <br>
                                    <label>قم بإيقاف التقييم</label>
                                    <input type="checkbox" style="text-align:right"  onchange="evaluationstatusdynamic({{ $value }})"/>
                                    <br>
                                    
                            </div>
                          
                                {{-- <input type="hidden" value="0" id="groupstatus_dynamic_{{$value}}" wire:model="group_status.{{$value}}">
                                    <input type="hidden" value="0" id="evaluationstatus_dynamic_{{$value}}" wire:model="evaluation_status.{{$value}}"> --}}
                                {{-- @php $countval = $value @endphp --}}
                                {{-- <input type="text" value="{{$value}}"> --}}
                                <div style="display: none" wire:ignore>
                                <input type="text"  id="groupstatus_dynamic_{{$value}}" wire:model="group_status.{{$value}}" >
                                <input type="text"  id="evaluationstatus_dynamic_{{$value}}" wire:model="evaluation_status.{{$value}}">
                                </div>    
                            
                            {{-- @if($showDiv) --}}
                                
                            {{-- @endif --}}
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
      @endif 
      @if($question_status == 2)  
            <form >
                  
                   <div class="row">
                        
                    <div style="text-align:right" class="col-md-12 mb-3">
                        <label>الإجابة(القيمة الدنيا)</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="min_value.0" required/>
                            @error('min_value.0')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>  
                        <div style="text-align:right" class="col-md-12 mb-3">
                        <label>الإجابة(القيمة العليا)</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="max_value.0" required/>
                            @error('max_value.0')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>  

                        <div style="text-align:right" class="col-md-12 mb-3">
                            <label>تقييم رقمي للإجابة</label>
                                <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="result_numrate.0" required/>
                                @error('result_numrate.0')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>  

                            
                          
                        <div style="text-align:right" class="col-md-12 mb-3">
                        <label>تقييم نصي للإجابة</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="result_textrate.0" required/>
                            @error('result_textrate.0')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        
                        

                        {{-- <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                            <label>هل تريد اظهار نص الوثيقة لليوزر حتي يرفق الوثيقة المناسبة؟</label>
                            <br>
                                <label>نعم</label>
                                <input type="radio" style="text-align:right"  value="1"   wire:model="pdf_text_status.0"  />
                                
                                <br>
                                <label>لا</label>
                                <input type="radio" style="text-align:right"  value="0"   wire:model="pdf_text_status.0" />
                                
                                @error('pdf_text_status.0')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div> --}}
                          
                        <div style="text-align:right;" class="col-md-12 mb-3"  >
                            <label>النص الذي يظهر لإدخال الوثيقة من اليوزر</label>
                                <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="pdf_text.0" required/>
                                @error('pdf_text.0')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>
                        
                        <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                            {{-- <label>تقييم نصي للإجابة</label>
                                <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="result_textrate.0" required/> --}}
                                {{-- @error('result_textrate.0')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror --}}
                                <label>قم بإيقاف اسئلة هذه المجموعة وانتقل الي المجموعة التي تليها</label>
                                <input type="checkbox"  onclick="groupstatusfirst()" />
    
                                <br>
                                <label>قم بإيقاف التقييم</label>
                                <input type="checkbox"  onclick="evaluationstatusfirst()" />
    
                                
                        </div>
                        <div style="display: none" wire:ignore>
                            <input type="text" id="groupstatusinput"  wire:model="group_status.0" >
                            <input type="text" id="evaluationstatusinput"  wire:model="evaluation_status.0" >
                        </div>

                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$question_id}}"  wire:model="question_id.0" hidden/>
                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$question_status}}"  wire:model="result_status.0" hidden/>
                        
                        
                        <div style="text-align:right;" class="col-md-12 mb-3">
                            <button class="btn btn-primary mb-3" wire:click.prevent="add({{$i}})">إضافة اجابة اخري</button>      
                            {{-- <input value="اضافه" style="background-color: crimson" type="submit" class="btn btn-primary"  name="image" /> --}}
                        </div>
                        {{-- Add Form --}}
                        @foreach ($inputs as $key => $value)

                        <div style="text-align:right" class="col-md-12 mb-3">
                        <label>الإجابة(القيمة الدنيا)</label>
                        <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="min_value.{{ $value }}" required/>
                        @error('min_value.')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>  
                    <div style="text-align:right" class="col-md-12 mb-3">
                    <label>الإجابة(القيمة العليا)</label>
                        <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="max_value.{{ $value }}" required/>
                        @error('max_value.')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>  

                    <div style="text-align:right" class="col-md-12 mb-3">
                        <label>تقييم رقمي للإجابة</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="result_numrate.{{ $value }}" required/>
                            @error('result_numrate.')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>  

                        
                      
                    <div style="text-align:right" class="col-md-12 mb-3">
                    <label>تقييم نصي للإجابة</label>
                        <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="result_textrate.{{ $value }}" required/>
                        @error('result_textrate.')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    
                    {{-- <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                        <label>هل تريد اظهار نص الوثيقة لليوزر حتي يرفق الوثيقة المناسبة؟</label>
                        <br>
                            <label>نعم</label>
                            <input type="radio" style="text-align:right"  value="1"   wire:model="pdf_text_status.{{ $value }}" onclick="opendivdy({{ $value }})"/>
                            
                            <br>
                            <label>لا</label>
                            <input type="radio" style="text-align:right"  value="0"   wire:model="pdf_text_status.{{ $value }}" onclick="closedivdy({{ $value }})"/>
                            
                            @error('pdf_text_status.')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                    </div> --}}

                    <div style="text-align:right;" class="col-md-12 mb-3" >
                        <label>النص الذي يظهر لإدخال الوثيقة من اليوزر</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="pdf_text.{{ $value }}" required/>
                            @error('pdf_text.')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                    </div>    
                    <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                                
                        <label>قم بإيقاف اسئلة هذه المجموعة وانتقل الي المجموعة التي تليها</label>
                        <input type="checkbox" style="text-align:right"  onchange="groupstatusdynamic({{ $value }})" />

                        <br>
                        <label>قم بإيقاف التقييم</label>
                        <input type="checkbox" style="text-align:right"  onchange="evaluationstatusdynamic({{ $value }})"/>
                        <br>
                        
                </div>
              
                    {{-- <input type="hidden" value="0" id="groupstatus_dynamic_{{$value}}" wire:model="group_status.{{$value}}">
                        <input type="hidden" value="0" id="evaluationstatus_dynamic_{{$value}}" wire:model="evaluation_status.{{$value}}"> --}}
                    {{-- @php $countval = $value @endphp --}}
                    {{-- <input type="text" value="{{$value}}"> --}}
                    <div style="display: none" wire:ignore>
                    <input type="text"  id="groupstatus_dynamic_{{$value}}" wire:model="group_status.{{$value}}" >
                    <input type="text"  id="evaluationstatus_dynamic_{{$value}}" wire:model="evaluation_status.{{$value}}">
                    </div>
                    
                    
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
        @endif 

        @if($question_status == 3)  
            <form >
                  
                   <div class="row">
                        
                        <div style="text-align:right" class="col-md-12 mb-3">
                        <label>الإجابة(نص)</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="result_value.0" required/>
                            @error('result_value.0')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>  

                        <div style="text-align:right" class="col-md-12 mb-3">
                            <label>تقييم رقمي للإجابة</label>
                                <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="result_numrate.0" required/>
                                @error('result_numrate.0')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>  

                            
                          
                        <div style="text-align:right" class="col-md-12 mb-3">
                        <label>تقييم نصي للإجابة</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="result_textrate.0" required/>
                            @error('result_textrate.0')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        
                        

                        {{-- <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                            <label>هل تريد اظهار نص الوثيقة لليوزر حتي يرفق الوثيقة المناسبة؟</label>
                            <br>
                                <label>نعم</label>
                                <input type="radio" style="text-align:right"  value="1"   wire:model="pdf_text_status.0" onclick="openDivfirst()"/>
                                
                                <br>
                                <label>لا</label>
                                <input type="radio" style="text-align:right"  value="0"   wire:model="pdf_text_status.0" onclick="closeDivfirst()"/>
                                
                                @error('pdf_text_status.0')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div> --}}

                        
                        <div style="text-align:right" class="col-md-12 mb-3" >
                            <label>النص الذي يظهر لإدخال الوثيقة من اليوزر</label>
                                <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="pdf_text.0" required/>
                                @error('pdf_text.0')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div> 
                
                        <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                            {{-- <label>تقييم نصي للإجابة</label>
                                <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="result_textrate.0" required/> --}}
                                {{-- @error('result_textrate.0')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror --}}
                                <label>قم بإيقاف اسئلة هذه المجموعة وانتقل الي المجموعة التي تليها</label>
                                <input type="checkbox"  onclick="groupstatusfirst()" />
    
                                <br>
                                <label>قم بإيقاف التقييم</label>
                                <input type="checkbox"  onclick="evaluationstatusfirst()" />
    
                                
                        </div>
                        <div style="display: none" wire:ignore>
                            <input type="text" id="groupstatusinput"  wire:model="group_status.0" >
                            <input type="text" id="evaluationstatusinput"  wire:model="evaluation_status.0" >
                        </div>

                        
                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$question_id}}"  wire:model="question_id.0" hidden/>
                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$question_status}}"  wire:model="result_status.0" hidden/>
                        
                        <div style="text-align:right;" class="col-md-12 mb-3">
                            <button class="btn btn-primary mb-3" wire:click.prevent="add({{$i}})">إضافة اجابة اخري</button>      
                            {{-- <input value="اضافه" style="background-color: crimson" type="submit" class="btn btn-primary"  name="image" /> --}}
                        </div>
                        {{-- Add Form --}}
                        @foreach ($inputs as $key => $value)

                        <div style="text-align:right" class="col-md-12 mb-3">
                            <label>الإجابة(نص)</label>
                                <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="result_value.{{ $value }}" required/>
                                @error('result_value.')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>  

                            <div style="text-align:right" class="col-md-12 mb-3">
                                <label>تقييم رقمي للإجابة</label>
                                    <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="result_numrate.{{ $value }}" required/>
                                    @error('result_numrate.')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>  

                                
                              
                            <div style="text-align:right" class="col-md-12 mb-3">
                            <label>تقييم نصي للإجابة</label>
                                <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="result_textrate.{{ $value }}" required/>
                                @error('result_textrate.')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            
                            

                            {{-- <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                                <label>هل تريد اظهار نص الوثيقة لليوزر حتي يرفق الوثيقة المناسبة؟</label>
                                <br>
                                    <label>نعم</label>
                                    <input type="radio" style="text-align:right"  value="1"   wire:model="pdf_text_status.{{ $value }}" onclick="opendivdy({{ $value }})"/>
                                    
                                    <br>
                                    <label>لا</label>
                                    <input type="radio" style="text-align:right"  value="0"   wire:model="pdf_text_status.{{ $value }}" onclick="closedivdy({{ $value }})"/>
                                    
                                    @error('pdf_text_status.')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                            </div> --}}

                            <div style="text-align:right;" class="col-md-12 mb-3" >
                                <label>النص الذي يظهر لإدخال الوثيقة من اليوزر</label>
                                    <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="pdf_text.{{ $value }}" required/>
                                    @error('pdf_text.')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                            </div> 

                            <div style="text-align:right" class="col-md-12 mb-3" wire:ignore>
                                
                                <label>قم بإيقاف اسئلة هذه المجموعة وانتقل الي المجموعة التي تليها</label>
                                <input type="checkbox" style="text-align:right"  onchange="groupstatusdynamic({{ $value }})" />
        
                                <br>
                                <label>قم بإيقاف التقييم</label>
                                <input type="checkbox" style="text-align:right"  onchange="evaluationstatusdynamic({{ $value }})"/>
                                <br>
                                
                        </div>
                      
                            {{-- <input type="hidden" value="0" id="groupstatus_dynamic_{{$value}}" wire:model="group_status.{{$value}}">
                                <input type="hidden" value="0" id="evaluationstatus_dynamic_{{$value}}" wire:model="evaluation_status.{{$value}}"> --}}
                            {{-- @php $countval = $value @endphp --}}
                            {{-- <input type="text" value="{{$value}}"> --}}
                            <div style="display: none" wire:ignore>
                            <input type="text"  id="groupstatus_dynamic_{{$value}}" wire:model="group_status.{{$value}}" >
                            <input type="text"  id="evaluationstatus_dynamic_{{$value}}" wire:model="evaluation_status.{{$value}}">
                            </div>
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
              <div class="table-responsive p-0">
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
              </div>
            </div>
          </div>
        </div>
    </div>
    
   

    {{-- <script>
        document.addEventListener('livewire:load', function () {
            // Your JS here.
            function opendivdy(id){
                $('#showDivdynamic_'+ id).show();
            }

        })
    </script> --}}



</div>  


{{-- <script>
   
    // function openDiv(id,e){
    //     console.log(e);
    //     var ele = e.parentNode.nextElementSibling.nextElementSibling;
    //     ele.classList.toggle('d-none');
    function openDiv(id){ 
    $('#showDiv').show();

    }

    // function closeDiv(id){
        
    //     document.getElementById('showDiv_' + id).classList.remove('d-block');
    //     document.getElementById('showDiv_' + id).classList.add('d-none');

    //     //$('#showDiv_'+ id).hide();

    // }

</script> --}}

 @section('script')
    {{-- <script>
        window.livewire.on('opendivddy',
            function opendivdyn(id) {
                    $('#showDivdynamic_'+ id).show();
            }
        );
            
            
        
    </script> --}}
    {{-- <script>
        window.livewire.on('opendivddy',function(odiv){
            //alert('welcome');
            $('#showDivdynamic_'+ odiv).show();
        }
        );    
    </script>--}}
    <script>
        function opendivdy(id){
            $('#showDivdynamic_'+ id).show();
            // document.getElementById('showDivdynamic_'+ id).css('style','display:block')pdfstatusyesdynamic_;
            // var pdfstatusyesdynamic = document.getElementById('pdfstatusyesdynamic_' + id);
            // var pdfstatusnodynamic = document.getElementById('pdfstatusnodynamic_' + id);
            // if(pdfstatusyesdynamic.value == 0){
            //     pdfstatusyesdynamic.value = 1;
            //     pdfstatusnodynamic.value = 0;
            //     // if(document.getElementById("closeDivradioo").disabled == false){
            //     //     document.getElementById("closeDivradioo").disabled=true;
            //     // }
            //     //document.getElementById("closeDivradioo").clear=true;
            //     document.getElementById("pdfstatusyesdynamic_" + id).dispatchEvent(new Event('input'));
            //     document.getElementById("pdfstatusnodynamic_" + id).dispatchEvent(new Event('input'));

            // }

        }
        function closedivdy(id){
            $('#showDivdynamic_'+ id).hide();
            // document.getElementById('showDivdynamic_'+ id).css('style','display:none');

            // var pdfstatusyesdynamic = document.getElementById('pdfstatusyesdynamic_' + id);
            // var pdfstatusnodynamic = document.getElementById('pdfstatusnodynamic_' + id);
            // if(pdfstatusnodynamic.value == 0){
            //     pdfstatusnodynamic.value = 1;
            //     pdfstatusyesdynamic.value = 0;
            //     // if(document.getElementById("closeDivradioo").disabled == false){
            //     //     document.getElementById("closeDivradioo").disabled=true;
            //     // }
            //     //document.getElementById("closeDivradioo").clear=true;
            //     document.getElementById("pdfstatusyesdynamic_" + id).dispatchEvent(new Event('input'));
            //     document.getElementById("pdfstatusnodynamic_" + id).dispatchEvent(new Event('input'));

            // }
        }
        function openDivfirst(){
            $('#showdivfirst').show();
            // var pdfstatusyesinput = document.getElementById('pdfstatusyesinput');
            // var pdfstatusnoinput = document.getElementById('pdfstatusnoinput');
            // if(pdfstatusyesinput.value == 0){
            //     pdfstatusyesinput.value = 1;
            //     pdfstatusnoinput.value = 0;
            //     // if(document.getElementById("closeDivradioo").disabled == false){
            //     //     document.getElementById("closeDivradioo").disabled=true;
            //     // }
            //     //document.getElementById("closeDivradioo").clear=true;
            //     document.getElementById("pdfstatusyesinput").dispatchEvent(new Event('input'));
            //     document.getElementById("pdfstatusnoinput").dispatchEvent(new Event('input'));

            // }

            // document.getElementById('showdivfirst').style = "display:block";

        }
        function closeDivfirst(){
            $('#showdivfirst').hide();
            // var pdfstatusyesinput = document.getElementById('pdfstatusyesinput');
            // var pdfstatusnoinput = document.getElementById('pdfstatusnoinput');
            // if(pdfstatusnoinput.value == 0){
            //     pdfstatusnoinput.value = 1;
            //     pdfstatusyesinput.value = 0;
            //     // if(document.getElementById("openDivradioo").disabled == false){
            //     //     document.getElementById("openDivradioo").disabled=true;
            //     // }
            //     //document.getElementById("openDivradioo").clear=true;
            //     document.getElementById("pdfstatusyesinput").dispatchEvent(new Event('input'));
            //     document.getElementById("pdfstatusnoinput").dispatchEvent(new Event('input'));
            // // document.getElementById('showdivfirst').style = "display:none";
            // }

        }
        function groupstatusfirst(){
            var groupstatusinput  = document.getElementById('groupstatusinput');
            if(groupstatusinput.value == 0){
                groupstatusinput.value = 1;
                document.getElementById("groupstatusinput").dispatchEvent(new Event('input'));

            }else{
                groupstatusinput.value = 0;
                document.getElementById("groupstatusinput").dispatchEvent(new Event('input'));

            }
            
        }
        function evaluationstatusfirst(){
            var evaluationstatusinput  = document.getElementById('evaluationstatusinput');
            if(evaluationstatusinput.value == 0){
                evaluationstatusinput.value = 1;
                document.getElementById("evaluationstatusinput").dispatchEvent(new Event('input'));

            }else{
                evaluationstatusinput.value = 0;
                document.getElementById("evaluationstatusinput").dispatchEvent(new Event('input'));

            }
        }
        function groupstatusdynamic(id){
            var groupstatus_dynamic  = document.getElementById('groupstatus_dynamic_' + id);
            if(groupstatus_dynamic.value == 0){
                groupstatus_dynamic.value = 1;
                document.getElementById('groupstatus_dynamic_' + id).dispatchEvent(new Event('input'));

            }else{
                groupstatus_dynamic.value = 0;
                document.getElementById('groupstatus_dynamic_' + id).dispatchEvent(new Event('input'));

            }
        }
        function evaluationstatusdynamic(id){
            var evaluationstatus_dynamic  = document.getElementById('evaluationstatus_dynamic_' + id);
            if(evaluationstatus_dynamic.value == 0){
                evaluationstatus_dynamic.value = 1;
                document.getElementById('evaluationstatus_dynamic_' + id).dispatchEvent(new Event('input'));

            }else{
                evaluationstatus_dynamic.value = 0;
                document.getElementById('evaluationstatus_dynamic_' + id).dispatchEvent(new Event('input'));

            }
        }
        

    </script>
    
@endsection 


