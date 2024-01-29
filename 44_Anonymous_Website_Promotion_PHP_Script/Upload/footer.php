<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/custom.js"></script>

<div id="openWebModal" class="modal fade openWebModal" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog">
			<div class="modal-content bg-dark shadow-lg">
                <form method="post" class="addWebsiteForm">
                    <div class="modal-header customBottomBorder">
                        <h4 class="modal-title text-warning"><i class="bi bi-globe2 text-warning"></i> <?php echo FORM_TITLE ; ?></h4>
                        <button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="form-group">
                            <label class="text-muted"><?php echo WEBSITE_TITLE ; ?>*</label>
                            <input type="text" name="title"  maxlength="50" class="customBorder form-control bg-dark text-white" required>
                        </div>
                        <div class="form-group mt-2">
                            <label class="text-muted"><?php echo SITE_URL_NAME ; ?>*</label>
                            <input type="url" name="url"  class="customBorder form-control bg-dark text-white" required>
                        </div>
                        <div class="form-group mt-4 text-center">
                            <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="dark" ></div>
                        </div>
                    </div>
                    <div class="modal-body text-center">
                        <div class="c-messages"></div>
                        <input type="hidden" name="btn_action" value="btnAddSite">
                        <button type="submit" class="btn btn-purple btn-md" id="action_log"><?php echo FORM_BTN_NAME ; ?></button>
                    </div>
                </form>
			</div>
	</div>
</div>

<div id="delWebModalIn" class="modal fade delWebModalIn" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
                <div class="modal-content bg-dark shadow-lg">
                    <form method="post" class="deleteWebsiteFormIn">
                        <div class="modal-header customBottomBorder">
                            <h4 class="modal-title text-danger"><i class="bi bi-trash text-danger"></i> <?php echo DELETEFORM_TITLE ; ?></h4>
                            <button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-start">
                            <div class="form-group">
                                <label class="text-muted"><?php echo PASSWORD_NAME ; ?>*</label>
                                <input type="password" name="password"  maxlength="50" class="customBorder form-control bg-dark text-white"  autocomplete="off">
                            </div>
                            <div class="form-group mt-4 text-center">
                                <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="dark" ></div>
                            </div>
                        </div>
                        <div class="modal-body text-center">
                            <div class="cr-messages"></div>
                            <input type="hidden" name="sid" class="sid" >
                            <input type="hidden" name="btn_action" value="btnDeleteSite">
                            <button type="submit" class="btn btn-danger btn-md" id="action_log"><?php echo DELETEFORM_BTN_NAME ; ?></button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

<div id="manualSearch" class="modal fade manualSearch">
	<div class="modal-dialog">
			<div class="modal-content  bg-dark">
                <form method="post" class="searchPost">
                    <div class="modal-header customBottomBorder">
                        <h4 class="modal-title text-danger"><i class="bi bi-search text-warning"></i> <?php echo SEARCH_TITLE ; ?></h4>
                        <button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="form-group">
                            <input required type="text" name="search_keyword" class="customBorder form-control bg-dark text-white" maxlength="100" placeholder="<?php echo SEARCH_PLACEHOLDER ; ?>" <?php if(isset($search)) { ?> value="<?php echo $search ; ?>" <?php } ?> >
                        </div>
                        <div class="form-group mt-2">
                            <div class="search-messages"></div>
                        </div>
                    </div>
                    <div class="modal-body text-end">
                        <input type="hidden" name="btn_action" value="manualUserSearch">
                        <button type="submit" class="btn btn-grey btn-md" id="action_log"><?php echo SEARCH_BTN ; ?></button>
                    </div>
                </form>
			</div>
	</div>
</div>

</div>
</div>
</div>
</body>
</html>