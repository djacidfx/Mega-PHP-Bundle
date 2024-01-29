<?php  include("header.php") ; ?>
<div class="col-lg-12 mt-1">
    <div class="card shadow-lg">
        <div class="card-header">
            <h1 class="text-muted text-start"> <i class="bi bi-question-circle-fill text-danger "></i> Questions </h1>
            <h6 class="text-danger text-start">Note : Use username in Questions, When User create Slambook then username will be replaced by User Original Name in Slambook.</h6>
        </div>
    </div>
</div>

<div class="col-lg-12  mt-4">
    <div class="remove-messages"></div>
    <div class="table-responsive bg-light p-3 text-start">
        <div class="col-lg-12 mb-3">
            <button class="openManualQuest ml-2 btn btn-sm btn-danger">+ Add Slambook Question</button>
        </div>             
        <table class="table table-bordered table-hover table-light" id="manageQuestionsTable">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Date</th>
                    <th>Question</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="manualQuest" class="modal fade manualQuest">
	<div class="modal-dialog">
			<div class="modal-content">
                <form method="post" class="saveQuest">
                    <div class="modal-header customBottomBorder">
                        <h4 class="modal-title text-danger"><i class="bi bi-plus-circle text-danger"></i> Add Question</h4>
                        <button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="form-group">
                            <label class="text-muted">Use username in Question</label>
                            <input type="text" name="question" class="question form-control " maxlength="100" required autocomplete="off" placeholder="Example : What's the nickname of username ?" autofocus>
                        </div>
                        <div class="form-group">
                            <div class="quest-messages"></div>
                        </div>
                    </div>
                    <div class="modal-body text-end">
                        <input type="hidden" name="pId" class="pId" >
                        <input type="hidden" name="btn_action" class="btn_action" >
                        <button type="submit" class="btn btn-danger btn-md action_log" id="action_log">Add</button>
                    </div>
                </form>
			</div>
	</div>
</div>

<?php  include("footer.php") ; ?>