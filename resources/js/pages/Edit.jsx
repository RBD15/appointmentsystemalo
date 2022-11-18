import React from "react";
import ReactDOM from "react-dom";

function Edit(props) {
    let params=JSON.parse(props.params)
    let model=JSON.parse(props.model)
    let fields=JSON.parse(props.fields)
    return (
        <div className="container" >
            <form method="POST">
                {
                    fields.map(field=>{
                        return (
                            <div className="mb-3" key={'campo'+field.name}>
                                <label for={field.name} className="form-label">{field.name}</label>
                                <input type={field.type} name={field.name} className="form-control" id={field.name} value={model[field.name]} aria-describedby="emailHelp"/>
                            </div>
                        )
                    })
                }
                <input type="hidden" name="_token" value={params.csrf} />
                <button type="submit" className="btn btn-primary" onSubmit={()=>{console.log('submit')}}>Edit</button>
            </form>
        </div>
    )
}

export default Edit;

if (document.getElementById('edit')) {
    const element = document.getElementById('edit')
    const props=Object.assign({},element.dataset)
    ReactDOM.render(<Edit {...props} />,
    document.getElementById('edit'));
}