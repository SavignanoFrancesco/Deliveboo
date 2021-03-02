<div id="dasboard-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box-top">
                        <div class="title">
                            <h1>Ciao {{Auth::user()->company_name}},</h1>
                            <p>Questa è la tua dashboard, qui puoi trovare i tuoi contenuti</p>
                            <a href="{{route('admin.home')}}" class="btn btn-light mt-5">Back-Office</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


