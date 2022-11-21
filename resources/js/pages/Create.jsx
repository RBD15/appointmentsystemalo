import React from "react";
import ReactDOM from "react-dom";

function Create(props) {
    let params=JSON.parse(props.params)
    console.log(params.route)
    let fields=JSON.parse(props.fields)
    return (
        <div className="container" >
            <form method="POST" action={params.route} >
                {
                    fields.map(field=>{
                        return (
                            <div className="mb-3" key={'campo'+field.name}>
                            <label for="exampleInputEmail1" className="form-label">{field.name}</label>
                            <input type={field.type} name={field.name} className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"/>
                            </div>
                        )
                    })
                }
                <input type="hidden" name="_token" value={params.csrf} />
                <button type="submit" className="btn btn-primary">Submit</button>
            </form>
        </div>
    )
}

export default Create;

if (document.getElementById('create')) {
    const element = document.getElementById('create')
    const props=Object.assign({},element.dataset)
    ReactDOM.render(<Create {...props} />,
    document.getElementById('create'));
}