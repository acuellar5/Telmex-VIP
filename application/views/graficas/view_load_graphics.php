<!-- remove this if you use Modernizr -->
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<a href="<?= URL::to('Graphics/view_graphics/BBVA') ?>" class="btn-cami-icon" title="Ver Graficas"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
<div class="content">
	<form method="post" enctype="multipart/form-data" id="formFileUpload">
		<div class="box">
			<input type="file" name="idarchivo" id="file-5" class="inputfile inputfile-4 hidden" data-multiple-caption="{count} files selected" multiple />
			<label for="file-5"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span>Choose a file...</span></label>
		</div>
		<button class="btn-cami_cool2" type="submit"> Subir Archivo <span class="glyphicon glyphicon-ok"></span></button>
	</form>
</div>
<script src="<?= URL::to("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>
<script src="<?= URL::to("assets/js/modules/graficas/loadBaseGraficas.js?v=" . time()) ?>" type="text/javascript"></script>