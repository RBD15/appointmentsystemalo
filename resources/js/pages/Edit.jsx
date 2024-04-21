import React, { useState } from "react";
import ReactDOM from "react-dom";

function Edit({model,params,fields}) {

    model  = JSON.parse(model)
    params = JSON.parse(params)
    fields = JSON.parse(fields)

    const [entityModel,setEntityModel] = useState(model)

    let route=params.route
    let url=window.location.hostname

    if(url=='localhost'){
        url = window.location.protocol+'//'+window.location.hostname+':'+window.location.port+route
    }


    const sendAction=(event)=>{
        event.preventDefault()

        let result = {}
        fields.map((field) => {
            result[field.name] = entityModel[field.name]
            return result
        })

        const data={
            mode:'cors',
            method:'PUT',
            headers:{
                Accept: 'application/json',
                'Content-Type':'application/json',
                'X-CSRF-TOKEN': params.csrf
            },
            body:JSON.stringify({...result})
        }

        console.log('Endpoint',`http://localhost:8000${route}/${entityModel.id}`);
        fetch('http://localhost:8000'+route+'/'+entityModel.id,data)
        .then(res=>
            res.json()
        )
        .then(res=>
            window.location=url
        )
        .catch(err=>{
            alert('City wasnt updated')
            console.error(err)
        })
    }

    const returnEntityDashboard = () => {
        window.location=url
    }

    return (
        <div className="container" >
            <form>
                {
                    fields.map((field,index)=>{
                        return (
                            <div className="mb-3" key={'campo'+field.name}>
                                <label for={field.name} className="form-label">{field.name}</label>
                                <input type={field.type} name={field.name} className="form-control" id={field.name} value={entityModel[field.name]} onChange={e => setEntityModel({...entityModel,[field.name]:e.target.value})} aria-describedby="emailHelp"/>
                            </div>
                        )
                    })
                }
                <input type="hidden" name="_token" value={params.csrf} />
                <button  className="btn btn-primary" onClick={sendAction}>Edit</button>
                <button  className="btn btn-success" onClick={returnEntityDashboard}>Volver</button>
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
