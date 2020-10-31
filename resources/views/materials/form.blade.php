<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>


                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    
                    <div class="box-body">

                        <div class="form-group">
                            <label >Nama Material</label>
                            <input type="text" class="form-control" id="nama_material" name="nama_material"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label>Satuan</label>
                            <select class="form-control" id="satuan" name="satuan" required="">
                                <option value=""></option>
                                <option value="meter">meter</option>
                                <option value="unit">unit</option>
                                <option value="buah">buah</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label >Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Volume Per Bulan</label>
                            <input type="number" class="form-control" id="volume_per_bulan" name="volume_per_bulan"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Harga Satuan</label>
                            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Transportasi dan Asuransi</label>
                            <input type="number" class="form-control" id="transportasi_dan_asuransi" name="transportasi_dan_asuransi"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >No. SPB</label>
                            <input type="text" class="form-control" id="no_spb" name="no_spb"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Pabrikan</label>
                            <input type="text" class="form-control" id="pabrikan" name="pabrikan"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >PRK</label>
                            <input type="text" class="form-control" id="prk" name="prk"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label> Jenis Material</label>
                            <select class="form-control" name="jenis_material" required="">
                                <option value=""></option>
                                <option value="app">App</option>
                                <option value="kabel">Kabel</option>
                                <option value="trafo">Trafo</option>
                                <option value="tiang_beton">Tiang Beton</option>
                                <option value="material_pendukung">Material Pendukung</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label >Total Volume Material</label>
                            <input type="number" class="form-control" id="total_vol_material" name="total_vol_material"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Total Material Datang</label>
                            <input type="number" class="form-control" id="total_mat_datang" name="total_mat_datang"   required>
                            <span class="help-block with-errors"></span>
                        </div>
                        
                        <div class="form-group">
                            <label >Category</label>
                            {!! Form::select('category_id', $category, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Category --', 'id' => 'category_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
