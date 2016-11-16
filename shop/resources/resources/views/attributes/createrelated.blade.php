<?php $user = App\User::find(Auth::user()->id);
$user_role = $user['role']['name']; ?>
@extends($user_role=='admin' ? 'new' : 'new_template.client.layouts.user_backend')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                @include('common/menucategory')
            </div>
            <div class="col-md-9">
                <div class="panel">
                    <header class="panel-heading">
                        {{ Lang::get('app.Relate Attributes') }}
                    </header>
                    <div class="panel-body">
                        @if( Session::has( 'success' ))
                            <div class="alert alert-success">{{ Session::get( 'success' ) }}</div>
                            @elseif( Session::has( 'warning' ))
                            {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
                        @endif
                        <?php $attribute_name="";?>
                        {!! Form::open(['url' => route("relate",array($category->slug,$category->id)), 'class' => 'form-horizontal', 'files'=>true, 'id'=>'real-dropzone']) !!}
                        <?php $categoryattributes = \Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=', $category->id)->where('name','=','Marke')->get();?>
                        <?php $categoryattributesmodel = \Illuminate\Support\Facades\DB::table('attributes')->where('category_id', '=', $category->id)->where('name','=','Model')->get();?>

                        <?php foreach($categoryattributes as $cattributes){?>
                                        <?php $attribute_name=$cattributes->name;?>
                                         <?php  $product_attributes_select= \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=',$cattributes->id)->get();?>
                        <?php } ?>

                        <?php $attribute_name_model="";?>
                                <?php $product_attributes_model=array();?>
                        <?php foreach($categoryattributesmodel as $cattributes){?>
                                        <?php $attribute_name_model=$cattributes->name;?>
                                         <?php  $product_attributes_model= \Illuminate\Support\Facades\DB::table('attributes_lists')->where('parent_attribute_id', '=',$cattributes->id)->where('related_item_id','=',0)->get();?>
                        <?php } ?>
                        <?php if($attribute_name!=""){?>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label"><?php echo $attribute_name;?></label>
                            <div class="col-md-10" style="margin-bottom:20px;">
                                <select class="form-control" name="mainattribute">
                                    <?php foreach($product_attributes_select as $pr){?>
                                    <option value="<?php echo $pr->id;?>">
                                        <?php echo $pr->item_value;?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label"><?php echo $attribute_name_model;?></label>
                            <div class="col-md-10">
                                <?php $count=0;?>
                                <?php foreach($product_attributes_model as $pr){?>
                                <?php $count++;?>
                                <input type="checkbox" name="relateditem[<?php echo $count;?>]" value="<?php echo $pr->id;?>"/><span style="padding-left:5px;"></span><?php echo $pr->item_value;?><br/>
                                <?php } ?>
                            </div>
                        </div>
                        <?php  } else {?>
                        <p><?php echo Lang::get('app.This category does not have any related attribute');?></p>
                        <?php  }?>
                        <div class="form-group">
                            <div class="col-sm-offset-8">
                                <input type="hidden" id="token" value="{{ csrf_token() }}">

                                <div class="col-md-3">
                                    {!! Form::submit("Save", array('class' => 'btn btn-success')) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! link_to_route('categoriesindex', trans('shop.cancel'), array(), array('class' => 'btn btn-danger admin'))!!}
                                </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <?php $related=\App\Attribute::where('related','=',1)->where('name','=','Marke')->get();?>
                            <?php $items_main=array();?>
                            <?php  foreach($related as $r){?>
                                 <?php $items_main=\App\AttributesList::where('parent_attribute_id','=',$r->id)->get();?>
                              <?php } ?>
                            <div class="col-md-3"></div>
                            <?php if($attribute_name!=""){?>
                            <div class="col-md-3">
                                <?php foreach($items_main as $rm){?>
                                    <b><?php echo $rm->item_value;?></b>
                                    <div class="" style="padding-left: 20px">

                                        <?php $items_related=\App\AttributesList::where('related_item_id','=',$rm->id)->get();?>
                                        <?php foreach($items_related as $ir){?>
                                            <a href="{{"/delete/relatedattribute/$category->slug/$category->id?attribute_id=$ir->id"}}"> <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;margin-top:10px;padding-right:10px;"></span></a><?php echo $ir->item_value;?><br/>

                                         <?php } ?>
                                    </div>
                                <?php }?>
                            </div>
                        <?php } ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        @endsection

        <style>
            .div-attribute {
                border: 1px solid gray;
                padding: 10px;
                margin-bottom: 30px;
            }
            .otheroptions{
                clear:left;
            }
        </style>

        @section('scripts')
            <script>
                $(document).ready(function(){

                })
            </script>
@endsection