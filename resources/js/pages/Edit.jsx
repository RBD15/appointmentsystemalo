import React, { useRef } from "react";
import ReactDOM from "react-dom";

function Edit(props) {
    let params=JSON.parse(props.params)
    let model=JSON.parse(props.model)
    let fields=JSON.parse(props.fields)
    let route=params.route
    const form = useRef()
    const sendAction=(event,model)=>{
        event.preventDefault()
        let url=window.location.hostname
        console.log(url)
        console.log(form)

        // if(url=='localhost'){
        //     url = window.location.protocol+'//'+window.location.hostname+':'+window.location.port+route
        // }
        // const data={
        //     mode:'cors',
        //     method:'PUT',
        //     headers:{
        //         Accept: 'application/json',
        //         'Content-Type':'application/json',
        //         'X-CSRF-TOKEN': token
        //     },
        //     body:{} 
        // }
        // fetch('http://localhost:8000'+route+'/'+model.id,data).then(
        //     res=>window.location.href=url
        // ).catch(err=>console.error(err))
    }

    return (
        <div className="container" >
            <form ref={form}>
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
                <button  className="btn btn-primary" onClick={(e)=>sendAction(e,model)}>Edit</button>
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