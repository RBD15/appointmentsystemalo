import React from "react";
import ReactDOM from "react-dom";

function Main() {

    return (
        <div className="container py-3">
            <header>
                <div className="pricing-header p-3 pb-md-4 mx-auto text-center">
                    <h1 className="display-4 fw-normal">Appointments system views</h1>
                    <p className="fs-5 text-muted"></p>
                </div>
            </header>

            <main>
                <div className="row row-cols-1 row-cols-md-3 mb-3 text-center">
                    <div className="col">
                        <div className="card mb-4 rounded-3 shadow-sm">
                            <div className="card-header py-3">
                                <h4 className="my-0 fw-normal">Patients</h4>
                            </div>
                            <div className="card-body">
                                <a href="/patient/create" className="w-100 btn btn-lg btn-success">Create</a>
                                <a href="/patient" className="w-100 btn btn-lg btn-primary">Show</a>
                            </div>
                        </div>
                    </div>
                    <div className="col">
                        <div className="card mb-4 rounded-3 shadow-sm">
                            <div className="card-header py-3">
                                <h4 className="my-0 fw-normal">Speciality</h4>
                            </div>
                            <div className="card-body">
                                <a href="/speciality/create" className="w-100 btn btn-lg btn-success">Create</a>
                                <a href="/speciality" className="w-100 btn btn-lg btn-primary">Show</a>
                            </div>
                        </div>
                    </div>
                    <div className="col">
                        <div className="card mb-4 rounded-3 shadow-sm">
                            <div className="card-header py-3">
                                <h4 className="my-0 fw-normal">Cities</h4>
                            </div>
                            <div className="card-body">
                                <a href="/city/create" className="w-100 btn btn-lg btn-success">Create</a>
                                <a href="/city" className="w-100 btn btn-lg btn-primary">Show</a>
                            </div>
                        </div>
                    </div>
                    <div className="col">
                        <div className="card mb-4 rounded-3 shadow-sm">
                            <div className="card-header py-3">
                                <h4 className="my-0 fw-normal">Doctors</h4>
                            </div>
                            <div className="card-body">
                                <a href="/doctor/create" className="w-100 btn btn-lg btn-success">Create</a>
                                <a href="/doctor" className="w-100 btn btn-lg btn-primary">Show</a>
                            </div>
                        </div>
                    </div>
                    <div className="col">
                        <div className="card mb-4 rounded-3 shadow-sm">
                            <div className="card-header py-3">
                                <h4 className="my-0 fw-normal">Plans</h4>
                            </div>
                            <div className="card-body">
                                <a href="/plan/create" className="w-100 btn btn-lg btn-success">Create</a>
                                <a href="/plan" className="w-100 btn btn-lg btn-primary">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    )

}

export default Main


if (document.getElementById('main')) {
    const element = document.getElementById('main')
    const props = Object.assign({ }, element.dataset)
    ReactDOM.render(<Main {...props} />,
    document.getElementById('main'));
}