<?php
    include("include/header.php");
?>
<style>
    .errClass{
        border:1px solid red
    }
</style>
<script>
    $(function(){
        $("#head-section").remove();
        $("header").css("top", "0");
        $(".breadcrumb").css("margin-top", "100px");
    })
</script>
<section style="margin-top:31px">
    <div class="container">
        <div class="row mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0" style="background-color: transparent; margin-left: 15px;">
                    <li class="breadcrumb-item"><a href="index" class="text-capitalize"><i class="fas fa-home"></i> Ana səhifə</a></li>
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">Yeni Elan</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 col-xl-8 order-2 order-xl-1">
                <form id="formAdd" autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="inputName">Adınız</label>
                        <input type="text" class="form-control name" id="inputName" name="inputName" placeholder="Adınızı daxil edin" minlength="2" required>
                        <div class="text-danger" id="errInputName"></div>
                    </div>
                    <div class="form-group">
                        <label for="selectUser">Elan verən</label>
                        <select class="form-control" id="selectUser" name="selectUser" required title="Burada elan verənin sahibliyi qeyd olunmalıdır. Şəxsdir yoxsa şirkətdir">
                            <option value="">Siyahıdan seçin</option>
                            <option value="own">Şəxsi</option>
                            <option value="company">Şirkət</option>
                        </select>
                        <div class="text-danger" id="errSelectUser"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" name="inputEmail" placeholder="Email addresinizi daxil edin" required>
                        <small id="emailHelp" class="form-text text-muted">E-poçtunuzu heç vaxt başqası ilə bölüşməyəcəyik.</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPhone">Telefon</label>
                        <input type="tel" class="form-control" id="inputPhone" name="inputPhone" placeholder="Nümunə: 0501234567"  maxlength="10" minlength="10" required pattern="0[0-9]{9}">
                        <div class="text-danger" id="errInputPhone"></div>
                    </div>
                    <hr style="margin:30px 0">
                    <div class="form-group">
                        <label for="selectsubCategory">Kateqoriya</label>
                        <select class="form-control" id="selectsubCategory" name="selectsubCategory" required>
                            <option value="">Siyahıdan seçin</option>
                            <?php
                                $category_list=mysqli_query($connect, "SELECT *  FROM categories"); ?>
                                <?php
                                    if(mysqli_num_rows($category_list) > 0){ ?>

                                    <?php while($category=mysqli_fetch_array($category_list)){ 
                                            $id=$category["category_id"];
                                            $subcategory_list=mysqli_query($connect, "SELECT *  FROM subcategories WHERE category_id='$id' "); 
                                            if(mysqli_num_rows($subcategory_list) > 0){ ?>
                                                <optgroup class="text-capitalize" label="<?php echo $category["category_title"] ?>">
                                                <?php
                                                    while($subcategory=mysqli_fetch_array($subcategory_list)){ ?>
                                                        <option value="<?php echo $subcategory["subcategory_id"] ?>"><?php echo $subcategory["subcategory_title"] ?></option>
                                                <?php  }
                                                ?>
                                            </optgroup>
                                        <?php    }
                                    } ?>
                                <?php    } else { ?>
                                    <option value="">Heç bir kateqoriya qeydə alınmayıb</option>
                                <?php    }
                                ?>
                        </select>
                        <div class="text-danger" id="errSelectsubCategory"></div>
                    </div>
                    <div id="properties" class="w-100"></div>
                    <div class="form-group" id="selectCityArea">
                        <label for="selectCity">Şəhər</label>
                        <select class="form-control" id="selectCity" name="selectCity" required>
                            <option value="">Siyahıdan seçin</option>
                            <?php
                                $city_list=mysqli_query($connect, "SELECT *  FROM cities ORDER BY city_title ASC");
                                while($city=mysqli_fetch_array($city_list)){ ?>
                                <option value="<?php echo $city["city_id"] ?>"><?php echo $city["city_title"] ?></option>
                            <?php  }
                            ?>
                        </select>
                        <div class="text-danger" id="errSelectCity"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputElanTitle">Elanın adı</label>
                        <input type="text" class="form-control" id="inputElanTitle" name="inputElanTitle" minlength="3" required placeholder="Elanın adını daxil edin">
                        <div class="text-danger" id="errInputElanTitle"></div>
                    </div>
                    <div class="form-group" id="priceInputArea">
                        <label for="inputPrice">Qiymət, AZN</label>
                        <input type="number" class="form-control" id="inputPrice" name="inputPrice"  minlength="1" required placeholder="Qiyməti daxil edin">
						<div class="text-danger" id="errInputPrice"></div>
                    </div>
                    <div class="form-group">
                        <label for="textareaAdd">Məzmun</label>
                        <textarea name="textareaAdd" class="form-control" id="textareaAdd" rows="7" aria-describedby="helpDescription" minlength="15" placeholder="Satdığınız məhsulu vəya göstərdiyiniz xidməti ətraflı şəkildə burada qeyd edin" required></textarea>
                        <div class="d-flex clearfix">
                            <small id="helpDescription" class="form-text text-muted w-100">
                                <span class="float-left">Mətnin minimal uzunluğu 15 karakter olmalıdır.</span>
                            </small>
                        </div>                        
                        <div class="text-danger" id="errTextareaAdd"></div>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input mb-2" multiple name="files[]" id="files" accept="image/jpeg, image/png, image/gif," aria-describedby="helpImage" required title="Şəkillər toplu halda seçilməlidir. Sonradan əlavə olunan şəkil əvvəldən toplu halda yüklənmiş şəkilləri silir.">
                        <label class="custom-file-label" for="files">Şəkil toplu halda seçin</label>
                        <small id="helpImage" class="form-text text-muted">Bir şəkilin maksimal həcmi 10 MB olmalıdır</small>
                        <div class="text-danger w-100" id="errMultiImg"></div>
                    </div>
                    <input type="hidden" name="allImages" value="" id="allImages">
                    <p class="mt-3">Siz elan yerləşdirərkən satan.az saytının <a href="rules">qaydalarıyla</a> razı olduğunuzu təsdiqləmiş olursunuz.</p>
                    <button type="submit" class="btn btn-primary text-capitalize custom-button">Elanı yarat</button>
                </form>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert" id="errorAdd" style="display:none"></div>
                    </div>
                </div>
            </div>
            <div class="d-none d-xl-block col-12 col-sm-9 col-md-7 col-lg-5 col-xl-4 order-1 order-xl-2 mb-3">
                <div class="card add-rules">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase position-relative mb-3 rulers">QIsa QAYDALAR</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Qaydalara riayət edin</h6>
                        <ul>
                            <?php
                                $rules_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='rules' LIMIT 7");
                                while($rules=mysqli_fetch_array($rules_list)){ ?>
                                    <li><?php echo $rules["parametres_value"] ?></li>
                            <?php   }
                            ?>
                        </ul>
                        <a href="rules" class="card-link">Saytın tam qaydaları</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    include("include/footer.php");
?>