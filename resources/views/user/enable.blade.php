@extends('layouts.appnew')

@section('content')
<style>
    input[type=radio] {
    width: 20px;
    height: 20px;
}

</style>

<div id="mymaincontent">
        <p></p>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid pb-4">
                    <!-- Main row -->
                    <div class="row">
                    <!-- Left col -->
                    <div class="col-md-12">
                        <!-- TABLE: DATA -->
                        <?php $action = ($user->activated == '0')?route('setenable',$user->id):route('setdisable',$user->id)?>;
                        <form method="POST" class="needs-validation" id="verifyDocForm" action="<?php echo $action; ?>">
                            @method('POST')
                            @csrf   
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <p></p>
                            <div class="card">
                                
                                <div class="card-header">
                                    <h3 class="card-title"><?php if($user->activated == '0') { echo 'Activation utilisateur'; } else echo 'Desactivation utilisateur';?></h3>
                                </div>
                                @if(Session::has('message'))
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ 
                                                                        Session::get('message') }}</p>
                                                        </div>
                                                    </div>
                                            @endif
                                <!-- /.card-header -->
                                <div class="card-body p-0 mt-3 mb-3">
                                    <!---start---->
                                        <div class="container rounded bg-white mt-5 mb-5">
                                            
                                            <div class="row">
                                                <div class="col-md-3 border-right">
                                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="<?php echo asset('images').'/'.$user->image; ?>"></div>
                                                </div>
                                                <div class="col-md-5 border-right">
                                                    <div class="p-3 py-5">
                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <h4 class="text-right">Profil utilisateur</h4>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-12"><label class="labels">Nom</label><input type="text" class="form-control" placeholder="first name" value="{{$user->name}}" disabled></div>
                                                            
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-12"><label class="labels">Entite</label><input type="text" class="form-control" placeholder="" value="<?php $zentite = App\Entity::getNameEntityById($user->entity_id); echo $zentite;?>" disabled></div>
                                                            <div class="col-md-12"><label class="labels">Fonction</label><input type="text" class="form-control" placeholder="" value="{{$user->function}}" disabled></div>
                                                            <div class="col-md-12"><label class="labels">Telephone</label><input type="text" class="form-control" placeholder="" value="{{$user->phone}}" disabled></div>
                                    
                                                            <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="" value="{{$user->email}}" disabled></div>
                                                            
                                                        </div>
                                                        
                                                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit"><?php if($user->activated == '0') { echo 'Activater utilisateur'; } else echo 'Desactivater utilisateur';?></button></div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="p-3 py-5">
                                                        <div class="d-flex justify-content-between align-items-center experience"><h4 class="text-right">Rôles utilisateur</h4></div><br>
                                                        <div class="col-md-12"><label class="labels">Activé</label>
                                                            <span><?php echo Helper::setOuiNon($user->activated) ?></span>
                                                           
                                                        </div>
                                                        <div class="col-md-12"><label class="labels">Administrateur</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="useradministrator" id="useradminyes" value="1" <?php if($user->administrator == '1') echo 'checked'?>>
                                                                    <label class="form-check-label" for="inlineRadio1">Oui</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="useradministrator" id="useradminno" value="0" <?php if($user->administrator == '0') echo 'checked'?>>
                                                                    <label class="form-check-label" for="inlineRadio2">Non</label>
                                                                </div>
                                                        </div>
                                                        <div class="col-md-12"><label class="labels">Valideur</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="uservalidator" id="uservalidyes" value="1" <?php if($user->validator == '1') echo 'checked'?>>
                                                                    <label class="form-check-label" for="inlineRadio1">Oui</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="uservalidator" id="uservalidno" value="0" <?php if($user->validator == '0') echo 'checked'?>>
                                                                    <label class="form-check-label" for="inlineRadio2">Non</label>
                                                                </div>
                                                        
                                                        </div>
                                                        <div class="col-md-12"><label class="labels">Repondeur</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="useranswering" id="useransweryes" value="1" <?php if($user->answering == '1') echo 'checked'?>>
                                                                    <label class="form-check-label" for="inlineRadio1">Oui</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="useranswering" id="useranswerno" value="0" <?php if($user->answering == '0') echo 'checked'?>>
                                                                    <label class="form-check-label" for="inlineRadio2">Non</label>
                                                                </div>
                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>

                                    <!---end------>
                                    
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </form>
                        <!-- /.card -->
                    </div>
                </div>
                    <!-- /.row -->
            </section>
        </div><!--/. container-fluid -->       
</div>
<script>
        jQuery(document).on('submit', 'form.needs-validation ', function (event) {
                                var form = jQuery("#verifyDocForm");
                                event.preventDefault();
                                Swal.fire({
                                    html: '<?php if($user->activated == '0') echo '<span class="text-lg">Etes vous sur de proceder à l activation de cet utilisateur ?</span>'; else {echo '<span class="text-lg">Etes vous sur de proceder à la desactivation de cet utilisateur ?</span>';} ?>',
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes',
                                    cancelButtonText: 'No'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    }
                                })

        })
</script>    
@endsection
