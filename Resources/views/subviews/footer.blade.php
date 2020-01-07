<div class="card-footer">
@includeWhen(!isset($dropzone), 'importwidget::subviews.footer.progressbar')
@includeWhen(isset($dropzone), 'importwidget::subviews.footer.dropzone')
</div>