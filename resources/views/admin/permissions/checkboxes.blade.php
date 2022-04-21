<?php
//Columns must be a factor of 12 (1,2,3,4,6,12)
$numOfCols = 4;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
foreach ($permissions as $id => $name){
  if($rowCount % $numOfCols == 0) { ?> <div class="row"> <?php }
    $rowCount++; ?>
        <div class="col-md-<?php echo $bootstrapColWidth; ?>">
            <div class="form-check mt-3 float-left">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="{{ $id }}" name="permissions[]"
                        {{ ($model->permissions->contains($id) || collect(old('permissions'))->contains($id)) ? 'checked' : '' }}>
                    {{ $name }}
                    <span class="form-check-sign"></span>
                </label>
            </div>
        </div>
<?php
    if($rowCount % $numOfCols == 0) { ?> </div> <?php } } ?>
